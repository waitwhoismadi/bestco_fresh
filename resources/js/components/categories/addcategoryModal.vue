<template>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">ADD NEW CATEGORY</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>


        <div class="modal-body">
            <form @submit.prevent="save_category()" method="post">
                <div class="form-group">
                    <label>Category Name*</label>
                    <input type="text" name="category_name" v-model="category_name" class="form-control" placeholder="Category Name">
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
            category_name:'',
            btn_disable:false,
            validation_errors:[],
        }
    },

    methods:{

         save_category(){
                this.btn_disable = true;
                axios.post(this.base_url+'/api/user/category',{category_name:this.category_name})
                .then(res => {

                    if(res.data.status == 'validation_errors'){
                        this.validation_errors = res.data.errors.category_name
                    }
                    else
                    {
                        this.$emit('save_category',res.data.data)
                        this.category_name='';

                    }
                    this.btn_disable = false;
                })
            }

    }
}
</script>
