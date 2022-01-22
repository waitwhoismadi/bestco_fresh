<template>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">ADD NEW TYPE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>


        <div class="modal-body">
            <form @submit.prevent="save_type()" method="post">
                <div class="form-group">
                    <label>type Name*</label>
                    <input type="text" name="type_name" v-model="type_name" class="form-control" placeholder="type Name">
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
            type_name:'',
            btn_disable:false,
            validation_errors:[],
        }
    },

    methods:{

         save_type(){
                this.btn_disable = true;
                axios.post(this.base_url+'/api/jobs/type',{type:this.type_name})
                .then(res => {

                    if(res.data.status == 'validation_errors'){
                        this.validation_errors = res.data.errors.type
                    }
                    else
                    {
                        this.$emit('save_type',res.data.data)
                        this.type_name='';

                    }
                    this.btn_disable = false;
                })
            }

    }
}
</script>
