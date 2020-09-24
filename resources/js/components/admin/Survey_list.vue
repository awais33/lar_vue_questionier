<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">Tests</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="javascript:void(0);">Add Tests</a>
            </li>
            <li class="breadcrumb-item">
              <a href="javascript:void(0);">Tables</a>
            </li>
            <li class="breadcrumb-item active">Survey List</li>
          </ol>
        </div>
      </div>
    </div>
    <!-- end row -->
    <div class="container">
      <button
        class="btn btn-primary"
        @click.prevent="add_survey"
        data-toggle="modal"
        data-target="#survey_modal"
      >Add New Test</button>
      <!-- add survey modal -->
      <div
        class="modal fade"
        id="survey_modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Add Topic</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class id="project_form">
                <div class="form-row">
                  <div class="form-group col-lg-12">
                    <label for="title">Title *</label>
                    <input
                      id="title"
                      name="title"
                      v-model="title"
                      type="text"
                      class="form-control"
                      placeholder="Title"
                    />
                    <span class="text-danger" v-if="errors.title">{{errors.title[0]}}</span>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-lg-12">
                    <label for="purpose">Purpose *</label>
                    <input
                      id="purpose"
                      name="purpose"
                      v-model="purpose"
                      type="text"
                      class="form-control"
                      placeholder="Purpose"
                    />
                    <span class="text-danger" v-if="errors.purpose">{{errors.purpose[0]}}</span>
                  </div>
                </div>
                 <div class="form-row">
                  <div class="form-group col-lg-12">
                    <label for="score">Score per Question *</label>
                    <input
                      id="score"
                      name="purpose"
                      v-model="score"
                      type="text"
                      class="form-control"
                      placeholder="Score"
                    />
                    <span class="text-danger" v-if="errors.score">{{errors.score[0]}}</span>
                  </div>
                </div>

                <div class="form-group">
                  <div>
                    <button
                      type="submit"
                      v-on:click.prevent="submit_survey"
                      class="btn btn-primary waves-effect waves-light"
                    >Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- modal ends -->
      <div
        class="row mt-2"
        v-for="(survey_list, index) in survey_lists"
        :key="index"
        @mouseover="mouseOver(survey_list)"
        @mouseleave="mouseLeave(survey_list)"
      >
        <div class="col-12">
          <div class="card m-b-20">
            <div class="card-body">
              <h4>{{survey_list.title}}</h4>
              <button
                class="btn btn-primary float-right"
                data-toggle="modal"
                data-target=".edit_survey_modal"
                @click.prevent="edit_survey(survey_list.id)"
                :style="{
                    display: survey_list.isHover
                    ? ``
                    : `none`
                    }"
              >Edit</button>

              <button
                class="btn btn-danger float-right mr-2"
                @click.prevent="delete_survey(survey_list.id)"
                :style="{
                    display: survey_list.isHover
                    ? ``
                    : `none`
                    }"
              >Delete</button>
            </div>
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->
      <!-- end row -->
    </div>

    <!-- end page content-->
  </div>
</template>

<script>

export default {
  data: function () {
    return {
      admin_token: "",
      survey_lists: "",
      title: "",
      purpose: "",
      errors: [],
      score: 2,
    };
  },
  methods: {
    mouseOver(survey_list) {
      this.$set(survey_list, "isHover", true);
    },
    mouseLeave(survey_list) {
      this.$set(survey_list, "isHover", false);
    },
    edit_survey(survey_id) {
      // console.log(survey_id)
      this.$router.push("/create_questionier/" + survey_id);
    },

    submit_survey: function () {
      axios
        .post("/api/admin/create_survey",
          {
                title: this.title,
                purpose: this.purpose,
                score: this.score,
            },
            {
                headers: {
                  Authorization: "Bearer " + this.admin_token,
                  Accept: 'application/json'
                },
        })
        .then((response) => {
          if (response.status === 200) {
            console.log("added successuly");
            $("#survey_modal").modal("hide");
            $("body").removeClass("modal-open");
            $(".modal-backdrop").remove();
            this.fetch_survey();
            var survey_id = response.data.survey_id;
            this.$router.push("/create_questionier/" + survey_id);
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {
            //this.$router.push({path: '/signup'})
            this.errors = error.response.data.errors;
          }
        });
    },

    fetch_survey() {
      const url = "/api/admin/survey_list";
      axios
        .get(url, {
             headers: {
                  Authorization: "Bearer " + this.admin_token,
                  Accept: 'application/json'
              }
        })
        .then((response) => {
          if (response.status === 200) {
            this.survey_lists = response.data;
            console.log(this.survey_lists);
          }
        })
        .catch((error) => {});
    },
    delete_survey(survey_id){
         axios
        .delete("/api/admin/delete_main_survey/" + survey_id,
        {
             headers: {
                  Authorization: "Bearer " + this.admin_token,
                  Accept: 'application/json'
                },
        })
        .then((response) => {
          if (response.status === 200) {
               this.fetch_survey();
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {

          }
        });
    },
    add_survey() {},
  },

  mounted() {
    var token = localStorage.getItem("admin_token")
    this.admin_token = token
    console.log(this.admin_token)
    this.fetch_survey();
  },
};
</script>

<style scoped>
</style>
