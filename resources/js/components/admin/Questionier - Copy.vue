<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">Add Contractor</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="javascript:void(0);">Builders</a>
            </li>
            <li class="breadcrumb-item">
              <a href="javascript:void(0);">Forms</a>
            </li>
            <li class="breadcrumb-item active">Add Contractor</li>
          </ol>
        </div>
      </div>
    </div>
    <!-- end row -->
    <div class="page-content-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="card m-b-20">
            <!-- Fetch questios starts here -->
            <div
              class="card-body"
              v-for="(question_list, index) in question_lists"
              :key="index"
              @mouseover="mouseOver(question_list)"
              @mouseleave="mouseLeave(question_list)"
            >
              <button
                class="btn btn-primary float-right"
                data-toggle="modal" data-target=".edit_survey_modal"
                @click.prevent="edit_survey(question_list.id)"
                :style="{
                    display: question_list.isHover
                    ? ``
                    : `none`
                    }"
              >Edit</button>

              <button
                class="btn btn-danger float-right mr-2"
                @click.prevent="delete_question(question_list.id, question_list.choices)"
                :style="{
                    display: question_list.isHover
                    ? ``
                    : `none`
                    }"
              >Delete</button>

              <h5>{{question_list.question}}</h5>
              <ul v-for="(choice, index) in question_list.choices" :key="index">
                <li>{{choice.choices}}</li>
              </ul>
            </div>
            <!-- fetch questions ends here -->


<!-- Modal -->
<div class="modal fade edit_survey_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
                <div class="form-row">
                  <div class="form-group col-lg-12">
                    <label for="name">Question</label>
                    <input
                      id="question"
                      name="question"
                      type="text"
                      class="form-control"
                      placeholder="Question"
                      v-model="show_question"
                    />

                  </div>
                </div>
                <div class="form-row">
                  <div
                    class="form-group col-lg-12"
                    v-for="(update_choice, update_choice_index) in update_choices.show_choice"
                    :key="update_choice_index">
                    <h1>{{update_choices.show_choice.length}}</h1>
                    <h6 v-if="update_choice_index == 0">Options</h6>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Choice Name"
                      v-model="update_choice.choices"

                    />
                    <button v-if="update_choice_index == update_choices.show_choice.length - 1"
                    class="btn btn-primary mt-2" type="submit" @click.prevent="add_choice_update">
                    Add Choice</button>
                    <button v-if="update_choice_index == update_choices.show_choice.length - 1"
                    class="btn btn-danger mt-2" type="submit">
                    Remove Choice</button>

                  </div>
                </div>

                <div class="form-group">
                  <div>
                    <button
                      type="submit"
                      class="btn btn-primary waves-effect waves-light"
                      @click.prevent="update_survey()"
                      id="submit"
                    >Update</button>
                  </div>
                </div>
              </form>
      </div>

    </div>
  </div>
</div>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card m-b-20">
            <div
              class="card-body"
              v-for="(questionier, index_q) in questioniers"
              :key="questionier.inputs.name"
            >
              <form>
                <div class="form-row">
                  <div class="form-group col-lg-12">
                    <label for="name">Question</label>
                    <input
                      id="question"
                      name="question"
                      type="text"
                      class="form-control"
                      placeholder="Question"
                      v-model="questionier.question"
                    />
                    <span
                      class="text-danger"
                      v-if="question_errors.question"
                    >{{question_errors.question[0]}}</span>
                  </div>
                </div>
                <div class="form-row">
                  <div
                    class="form-group col-lg-12"
                    v-for="(input, index_a) in inputs"
                    :key="index_a"
                  >

                    <input
                      type="text"
                      class="form-control"
                      placeholder="Choice Name"
                      v-model="input.choice_name"
                    />
                    <button class="btn btn-primary mt-2" type="submit" @click.prevent="addchoice">Add Choice</button>
                    <span
                      class="text-danger"
                      v-if="question_errors.choices"
                    >{{question_errors.choices[0]}}</span>
                  </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-lg-12">
                         <select class="form-control" v-model="right_answer">

                            <option v-for="(option, opt_index) in options" v-bind:value="option.value"
                            :key="opt_index">
                                {{ option.text }}
                            </option>
                         </select>
                    </div>
                </div>

                 <div class="form-row">
                    <div class="form-group col-lg-12">
                        <label for="score"> Enter Score </label>
                         <input type="text" class="form-control" id="score" v-model="score" >
                    </div>
                </div>

                <div class="form-group">
                  <div>
                    <button
                      type="submit"
                      class="btn btn-primary waves-effect waves-light"
                      id="submit"
                      v-on:click.prevent="[forchoices(index_q, index_a)]"
                    >Add Question</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
        <!-- end col -->

        <!-- end col -->
      </div>
      <!-- end row -->
    </div>
    <!-- end page content-->

  </div>
</template>

<script>
import $ from 'jquery'
export default {
  data() {
    return {

      title: "",
      q_id: "",
      question_id: "",
      question_lists: "",
      choice_lists: [],
      show_question:"",
      right_answer: "",
      score: 2,

      update_choices: [
          {
            show_choice: "",
          },
      ],
      //addquestions: false,
      options: [
      { text: 'a', value: 'a' },
      { text: 'b', value: 'b' },
      { text: 'c', value: 'c' },
      { text: 'd', value: 'd' }
    ],
      choices_arrray: [],
      question_errors: [],
      choice_errors: [],
      inputs: [
        {
          choice_name: "",
        },
      ],

      questioniers: [
        {
          question: "",
          inputs: [
            {
              choice_name: "",
            },
          ],
        },
      ],
    };
  },

  methods: {
    addquestions() {
      this.questioniers.push({
        question: "",
        inputs: [
          {
            choice_name: "",
          },
        ],
      });
    },

    addchoice() {
      this.inputs.push({
        choice_name: "",
      });
    },

    forchoices(index_q, index_a) {
      for (var i = 0; i < this.inputs.length; i++) {
        var choices = this.inputs[i].choice_name;
        console.log(this.inputs.length);
        this.choices_arrray.push(choices);
        this.choices_arrray.splice(i + 1, this.inputs.length);
      }
      console.log(this.choices_arrray);

      //alert("hello")
      this.submitquestions(index_q, index_a);
    },

    submitquestions(index_q, index_a) {
      axios
        .post("/api/admin/create_questioniers/" + this.$route.params.id, {
          question: this.questioniers[index_q].question,
          choices: this.choices_arrray,
          right_answer: this.right_answer,
          score: this.score,
        })
        .then((response) => {
          if (response.status === 200) {
            this.choices_arrray.splice(index_a, this.inputs.length);
            //this.addquestions()

            this.get_latest();
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.question_errors = error.response.data.question_errors;
          }
        });
    },

    get_latest() {
      const latest_data = "/api/admin/latest_question/" + this.$route.params.id;
      axios
        .get(latest_data, {})
        .then((response) => {
          if (response.status === 200) {
            this.question_lists = response.data;
            console.log(this.question_lists);
          }
        })
        .catch((error) => {});
    },

    mouseOver(question_list) {
      this.$set(question_list, "isHover", true);
    },
    mouseLeave(question_list) {
      this.$set(question_list, "isHover", false);
    },

    edit_survey(question_id){
        //alert(question_id)
        axios
        .get("/api/admin/edit_surveys/" + this.$route.params.id +"/"+ question_id, {

        })
        .then((response) => {
          if (response.status === 200) {
              this.show_question = response.data[0].question
              this.question_id = response.data[0].id
              this.update_choices.show_choice = response.data[0].choices
              console.log(this.question_id)
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.question_errors = error.response.data.question_errors;

          }
        });
    },

    add_choice_update() {
      this.update_choices.push({
        show_choice: "",
      });
    },

    update_survey(){
        axios
        .post("/api/admin/update_survey/" + this.$route.params.id, {
          question: this.show_question,
          question_id: this.question_id,
          choices: this.update_choices.show_choice,
        })
        .then((response) => {
          if (response.status === 200) {

              this.get_latest();
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.question_errors = error.response.data.question_errors;
          }
        });
    },

    delete_question(delete_question_id, delete_choices){

        axios
        .delete("/api/admin/delete_survey/" + this.$route.params.id, {
            data:{
                 question_id: delete_question_id,
                 choices: delete_choices,
            }
        })
        .then((response) => {
          if (response.status === 200) {
              this.get_latest();
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.question_errors = error.response.data.question_errors;
          }
        });
    }
  },

  mounted() {


    this.get_latest();
    const url = "/api/admin/get_survey/" + this.$route.params.id;
    axios
      .get(url, {})
      .then((response) => {
        if (response.status === 200) {
          this.title = response.data.survey.title;
          //console.log(title)
        }
      })
      .catch((error) => {});

    //   const get_question = "/api/admin/question_list/" + this.$route.params.id;
    // axios
    //   .get(get_question, {})
    //   .then((response) => {
    //     if (response.status === 200) {
    //       this.question_lists = response.data;
    //       console.log(this.choice_lists)
    //     }
    //   })
    //   .catch((error) => {});
  },
};
</script>

<style scoped>
</style>
