<template>
    <div class="w-100">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">All Categories</h4>
            <button class="float-right btn btn-primary" @click="add_category()">Add Category</button>



      <v-client-table :columns="columns" v-model="categories" :options="options">
        <div slot="action" slot-scope="{ row }"><a href="#/">
                        <button class="btn btn-icons btn-rounded btn-success" @click="edit_category(row)"><i class="fa fa-pencil"></i></button></a>
                        <button class="btn btn-icons btn-rounded btn-danger" @click="delete_category(row.id)"><i class="fa fa-trash-o"></i></button></div>
      </v-client-table>
          </div>
        </div>


        <!----------------add category------------------>
        <div class="modal fade" id="add_categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <add_category :base_url="base_url" @save_category="save_category($event)"></add_category>
        </div>

        <!----------------edit category------------------>
        <div class="modal fade" id="edit_categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <edit_category :base_url="base_url" :category="category" @update_category="update_category($event)"></edit_category>
        </div>

    </div>
</template>

<script>
import ClientTable from 'vue-client-table';
import add_category from './addcategoryModal.vue';
import edit_category from './editcategoryModal.vue';
export default {

components:{
    ClientTable,
    add_category,
    edit_category
},
        props: ['base_url'],

        data(){
            return {
                categories:[],
                category:'',
                columns: ['category_name','action'],
    options: {
      headings: {
        category_name: 'Category Name',
        action:'Action'

      },
      editableColumns:['category_name'],
      sortable: ['category_name'],
      filterable: ['category_name']
    }
  }

        },

        mounted(){
            this.getcategories();

        },

        methods:{

            getcategories() {
                axios.get(this.base_url+'/api/user/category')
                .then(res => (
                    this.categories = res.data
                ))
            },

            add_category(){
                $('#add_categoryModal').modal('toggle');
            },

            save_category(data){
                this.categories.push(data);
                $('#add_categoryModal').modal('hide');
                notify_message('Category Added Successfully','success')
            },

            delete_category(cat_id){
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover thisfile!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.delete(this.base_url+'/api/user/category/'+cat_id)
                        .then(res => {

                            if(res.data.status == 'error'){
                                swal({
                                    text:res.data.msg,
                                    icon:'warning'
                                })
                            }
                            else{
                             notify_message(res.data.msg,'success');
                             this.getcategories();
                            }
                        })
                    }
                });
            },

            edit_category(category){
                $('#edit_categoryModal').modal('toggle');
                this.category = category;
            },

            update_category(data){
                this.getcategories();
                $('#edit_categoryModal').modal('hide');
                notify_message('Category Updated Successfully','success')
            },

        }

}
</script>

<style>
td:focus, th:focus{
    border: 0px;
    outline: none;
}
</style>
