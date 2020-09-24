<template>
<div class="container">
    <h1>Result</h1>
    <!-- <h1 v-if="!new_answers">Please take Test and go back</h1>
    <h1 v-else> Result for Test </h1> -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title text-center">
                        Result
                    </h4>
                    <!-- <ul>
                        <li v-for="(item, index) in new_answers" :key="index">
                            {{index}}
                            {{item}}
                        </li>
                    </ul> -->
                       <table class="table">
  <tbody>
      <tr>
      <th scope="row">Test Name</th>
      <td>{{title}}</td>
    </tr>
    <tr>
      <th scope="row">Total Questions</th>
      <td>{{total_questions}}</td>

    </tr>
    <tr>
      <th scope="row"> Right Answers </th>
      <td> {{total_correct_ans}} </td>

    </tr>
    <tr>
      <th scope="row">Total Numbers</th>
      <td>{{total_numbers}}</td>

    </tr>
    <tr>
      <th scope="row">Gained Numbers</th>
      <td>{{gained_numbers}}</td>

    </tr>
    <tr>
      <th scope="row">Percentage</th>
      <td>{{percent}}</td>

    </tr>
  </tbody>
            </table>
                </div>
            </div>

        </div>
    </div>

</div>
</template>

<script>
//import { serverBus } from './../app'

export default {
    name: 'Result',

    data(){
        return{
            title: '',
            answers: '',
            total_questions: '',
            total_correct_ans: '',
            total_numbers: '',
            gained_numbers: '',
            percent: '',
        }
    },
//     mounted(){
//         if (window.performance) {
//   console.info("window.performance works fine on this browser");
// }
// console.info(performance.navigation.type);
// if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
//   alert('please give the test again')
//   window.location.href = '/survey'
// } else {
//   console.info( "This page is not reloaded");
// }
//     },

    created() {
         if(this.$route.params.t_title){
       this.title = this.$route.params.t_title
         }

       if(this.$route.params.right_ans){
       this.answers = this.$route.params.right_ans
       this.total_correct_ans = this.$route.params.right_ans.length
       this.gained_numbers = this.total_correct_ans * this.$route.params.score
       }

       if(this.$route.params.tot_questions){
       this.total_questions = this.$route.params.tot_questions
       this.total_numbers = this.total_questions * this.$route.params.score
       this.percent = this.gained_numbers/this.total_numbers * 100 + '%'
       }
       console.log(this.total_correct_ans)

},
}
</script>

<style scoped>

</style>
