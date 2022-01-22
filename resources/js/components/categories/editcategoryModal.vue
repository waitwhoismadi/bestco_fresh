<template>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">UPDATE CATEGORY</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>


        <div class="modal-body">
            <form @submit.prevent="update_category()" method="post">
                <div class="form-group">
                    <label>Category Name*</label>
                    <input type="text" name="category_name" v-model="category.category_name" class="form-control" placeholder="Category Name">
                    <div class="text-danger" v-for="error in validation_errors" :key="error">
                        {{ error }}
                    </div>
                </div>

                <button type="submit" class="btn btn-success" :disabled="btn_disable">Update</button>
            </form>
        </div>

        </div>
    </div>
</template>

<script>
export default {
    props:['base_url','category'],

    data(){
        return{
            btn_disable:false,
            validation_errors:[],
        }
    },

    methods:{

         update_category(){
                this.btn_disable = true;
                axios.put(this.base_url+'/api/user/category/'+this.category.id,{category_name:this.category.category_name})
                .then(res => {

                    if(res.data.status == 'validation_errors'){
                        this.validation_errors = res.data.errors.category_name
                    }
                    else
                    {
                        this.$emit('update_category',res.data.data)


                    }
                    this.btn_disable = false;
                })
            }

    }
}
</script>
