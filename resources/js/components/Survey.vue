<template>

<div>


    <div class="container">
        <div class="row">
             <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">
                                Take Tests
                            </h4>
                            <form class="" action="#">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="survey">Select Topic</label>
                                        <select id="survey" class="form-control"
                                        @change="onchange($event)"  v-model="key" required>
                                            <option  v-for="(survey, index) in surveys" :key="index"
                                            :value="survey.id" selected :data-foo="survey.title">
                                            {{survey.title}}</option>
                                        </select>
                                    </div>

                                </div>
                                 <div class="form-row" v-for="(question, q_index) in questions"
                                 :key="q_index">
                                    <div class="form-group col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <label for="survey">
                                                    <span class="font-weight-bold"> Q No.{{q_index+1}} </span>
                                                   <span class="ml-2">{{question.question}}</span> </label>

                                            </div>
                                        </div>
                                        <ul  v-for="(choice, c_index) in question.choices"
                                                :key="c_index">
                                            <li class="list-unstyled">
                                                 <label :id="choice.id"
                                                 class="col-md-12 bg-light p-4 m-0">

                                                <input type="checkbox" :value="choice.id"
                                                :class="'check_choice' + q_index"
                                                :id="choice.id"
                                                @change="uniqueCheck(q_index, choice.id,
                                                question.id, question.survey_id, choice.options)"
                                                 v-model="choice_value"
                                                 :name="'answer' + choice.id" required>
                                                {{choice.choices}}
                                                </label>
                                            </li>
                                        </ul>

                                    </div>

                                </div>


                                <div class="form-group">
                                    <div>
                                        <button
                                            type="submit"
                                            class="btn btn-primary waves-effect waves-light"
                                            @click.prevent="submit_survey(); get_result()"
                                        >
                                            Submit
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
</template>

<script>
import $ from 'jquery'
import { serverBus } from './../app'
export default {
    name: 'Survey',

    data(){
        return{
            key: "",
            surveys: "",
            questions: "",
            choice_value: [],
            answers: [],
            survey_results:{},
            canidate_answers:{},
            right_answer:[],
            fetch_right_answers:{},
            right_answer_array:"",
            results: [],
            correct_ans: [],
            wrong_ans: [],
            lists:['a', 'b', 'c'],
            resultComponent: 'Result',
            test: '',
            total_questions: '',
            test_title: '',
            score: '',
        }
    },


    methods:{
    onchange(event){
         axios
        .post("/api/user/fetch_questions/" + this.key, {

        })
        .then((response) => {
          if (response.status === 200) {
           this.questions = response.data
            //console.log(this.questions)
            this.total_questions = this.questions.length
            console.log(this.total_questions)
            this.get_rightanswers(this.key)

            var optionText = event.target.options[event.target.options.selectedIndex].text;
            this.test_title = optionText
           // console.log(this.test_title)

            this.surveys.forEach(element => {
                if(element.id === this.key){
                    // /console.log(element.score)
                    this.score = element.score
                }
            });
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {

          }
        });
    },

     get_rightanswers(survey_id){
         const url = "/api/user/rightanswers_list/" + survey_id;
      axios
        .get(url, {})
        .then((response) => {
          if (response.status === 200) {
              this.right_answer = response.data

              console.log( this.right_answer )
          }
        })
        .catch((error) => {});
     },

     uniqueCheck(q_index, choice_id, question_id, survey_id, options){
        console.log(options)
        this.survey_results[q_index] = {
            "survey_id": survey_id,
            "question": question_id,
            "answer" : choice_id,
        }

        this.canidate_answers[q_index]={
             options
        }

                 console.log( this.canidate_answers)

          $('.check_choice' + q_index).on('change', function() {
        $('.check_choice' + q_index).not(this).prop('checked', false)

        });
    },
    submit_survey(){

        //  axios
        // .post("/api/user/submit_answers/", {
        //     results: this.survey_results,
        // })
        // .then((response) => {
        //   if (response.status === 200) {
        //    this.questions = response.data
        //     console.log(this.questions)
        //   }
        // })
        // .catch((error) => {
        //   if (error.response.status == 422) {

        //   }
        // });
    },

    get_result(){

        var right_answer_array = []
       const resultArray = Object.values(this.canidate_answers);
       for(var result in resultArray){

           for(var item in resultArray[result]){
               var right_answer = resultArray[result][item]
               right_answer_array.push(right_answer)
           }
       }
       console.log(right_answer_array)

    //    right_answer_array.forEach((e1) => this.right_answer.forEach((e2)=>
    //     {
    //         if(e1 === e2)
    //         {
    //             final_Array.push(e1)
    //         }
    //     }

    //     ));

//      right_answer_array.forEach((e1,i)=>this.right_answer.forEach(e2=>{

//          if(e1.length > 1 && e2.length){
//             result = compare(e1,e2);
//          }else if(e1 !== e2 ){
//             result = false
//             this.wrong_ans.push(result)
//          }else{
//             result = true
//             this.correct_ans.push(result)
//          }
//     })
//   )



        // for (var i = 0; i < right_answer_array.length; ++i) {
        //     for (var j = 0; j < this.right_answer.length; ++j) {
        //         if (right_answer_array[i] ===this.right_answer[j])
        //         this.correct_ans.push(right_answer_array[i]);
        //  }
        //  }

        var ans_list = this.right_answer
        var correct_ans = this.correct_ans
        var wrong_ans = this.wrong_ans
         correct_ans.splice(0, correct_ans.length)
         wrong_ans.splice(0, wrong_ans.length)
        // right_answer_array = right_answer_array.filter(function(val) {
        // if(ans_list.indexOf(val) === -1){
        //     wrong_ans.push(val)
        // }else{
        //     correct_ans.push(val)
        // }
        // });

        // var filteredKeywords = right_answer_array.filter((word) => !ans_list.includes(word));
        //     console.log(filteredKeywords);

        if (right_answer_array.length !== ans_list.length) return false;
    for (var i = 0, len = right_answer_array.length; i < len; i++){
        if (right_answer_array[i] !== ans_list[i]){
            wrong_ans.push(right_answer_array[i])
        }
        else{
            correct_ans.push(right_answer_array[i])
        }
    }
         console.log(this.correct_ans)
          console.log(wrong_ans)
          this.$router.push({name: 'Result',
          params: {
              'right_ans': this.correct_ans,
              'tot_questions': this.total_questions,
              't_title': this.test_title,
              'score': this.score,
              }
          })
            //serverBus.$emit('correct_ans', this.lists);

    },

},

beforeCreate()
    {
        if (localStorage.getItem('login_token') == null || localStorage.getItem('login_token') == ""){
        this.$router.push('/signin')
        }
},
mounted(){
 const url = "/api/user/survey_list";
      axios
        .get(url, {})
        .then((response) => {
          if (response.status === 200) {
            this.surveys = response.data
            console.log(this.surveys)
          }
        })
        .catch((error) => {});
},
}

</script>

<style scoped>

</style>
