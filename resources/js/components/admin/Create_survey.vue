<template>
     <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"><h4 class="page-title">Data Table</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Agroxa</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Data Table</li>
                    </ol>

                </div>
            </div>
        </div><!-- end row -->
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body"><h4 class="mt-0 header-title">Project List with CA No</h4>

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#survey_modal">
  Create Survey
</button>

<!-- Modal -->
<div class="modal fade" id="survey_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="" id="project_form">

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
                                        <span class="text-danger" v-if="errors.title"> {{errors.title[0]}} </span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-12 ">
                                        <label for="purpose">Purpose</label>
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

                        <div class="form-group">
                            <div>
                                <button
                                    type="submit"
                                    v-on:click.prevent="submit_survey"
                                    class="btn btn-primary waves-effect waves-light">Submit
                                </button>

                            </div>
                        </div>
                        </form>

      </div>

    </div>
  </div>
</div>
                        </div>
                    </div>
                </div><!-- end col --></div><!-- end row -->
            <!-- end row --></div><!-- end page content--></div>

</template>

<script>
const token = localStorage.getItem("admin_token");
export default {
    data(){
        return{
            title: '',
            purpose: '',
            errors: [],
        }
    },

    methods:{
        submit_survey: function(){
            console.log(token)
            axios.post('/api/admin/create_survey',
            {
                title: this.title,
                purpose: this.purpose,
            },
            {
                headers: {
                  Authorization: "Bearer " + token
                },
    })
    .then(function(response) {
        if(response.status === 200){
            console.log('added successuly');
            $('#survey_modal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            var survey_id = response.data.survey_id;
            this.$router.push({name: 'create_questionier'});
        }
    })
    .catch(error => {

        if (error.response.status == 422) {
        //this.$router.push({path: '/signup'})
        this.errors = error.response.data.errors;

        }
        });

        }
    },
    created(){
      console.log(token)
  },
}
</script>

<style scoped>

</style>
