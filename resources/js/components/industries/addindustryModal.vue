<template>

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">ADD NEW INDUSTRY</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>


        <div class="modal-body">
            <form @submit.prevent="save_industry()" method="post">
                <div class="form-group">
                    <label>industry Name*</label>
                    <input type="text" name="industry_name" v-model="industry_name" class="form-control" placeholder="industry Name">
                    <div class="text-danger" v-for="error in validation_errors" :key="error">
                        {{ error }}
                    </div>
                </div>

                <button type="submit" class="btn btn-success" :disabled="btn_disable">Save</button>
            </form>
        </div>

        </div>
    </div>
</template>

<script>
export default {
    props:['base_url'],

    data(){
        return{
            industry_name:'',
            btn_disable:false,
            validation_errors:[],
        }
    },

    methods:{

         save_industry(){
                this.btn_disable = true;
                axios.post(this.base_url+'/api/company/industry',{industry_name:this.industry_name})
                .then(res => {

                    if(res.data.status == 'validation_errors'){
                        this.validation_errors = res.data.errors.industry_name
                    }
                    else
                    {
                        this.$emit('save_industry',res.data.data)
                        this.industry_name = '';

                    }
                    this.btn_disable = false;
                })
            }

    }
}
</script>
