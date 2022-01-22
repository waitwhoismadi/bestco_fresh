<template>

<div>

            <div class="posts-bar" v-for="job in jobs" :key="job.id">
                 <div class="post-bar bgclr">
                     <div class="wordpressdevlp">
                         <h2>{{ job.title}}</h2>

                         <p><i class="la la-clock-o"></i>Posted on 30 August 2018</p>
                     </div>
                     <br>
                     <div class="row no-gutters">
                         <div class="col-md-6 col-sm-12">
                             <div class="cadidatesbtn">
                                 <button type="button" class="btn btn-primary">
                                     <span class="badge badge-light"></span>Candidates
                                 </button>
                                 <a href="#">
                                     <i class="far fa-edit"></i>
                                 </a>
                                 <a href="#">
                                     <i class="far fa-trash-alt"></i>
                                 </a>
                             </div>
                         </div>
                         <div class="col-md-6 col-sm-12">
                             <ul class="bk-links bklink">
                                 <li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
                                 <li><a href="#" title=""><i class="la la-envelope"></i></a></li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>

</div>
</template>

<style>

</style>

<script>
export default {

    props:{
        user:
        {
        type: String
        },
        base_url:
        {
        type: String
        },
    },

    data(){
        return {
            jobs:[],

        }
    },

    mounted(){
        this.getjobs();
        console.log(this.user);
    },

    methods:{

        getjobs(){

            axios.
            get(this.base_url+'/api/jobs/'+this.user)
            .then(res => (
                this.jobs = res.data
            ))
        },
    },
}
</script>
