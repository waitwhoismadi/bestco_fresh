<template>
    <div class="w-100">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">All Industries</h4>
            <button class="float-right btn btn-primary" @click="add_industry()">Add industry</button>



      <v-client-table :columns="columns" v-model="industries" :options="options">
        <div slot="action" slot-scope="{ row }"><a href="#/">
                        <button class="btn btn-icons btn-rounded btn-success" @click="edit_industry(row)"><i class="fa fa-pencil"></i></button></a>
                        <button class="btn btn-icons btn-rounded btn-danger" @click="delete_industry(row.id)"><i class="fa fa-trash-o"></i></button></div>
      </v-client-table>
          </div>
        </div>


        <!----------------add industry------------------>
        <div class="modal fade" id="add_industryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <add_industry :base_url="base_url" @save_industry="save_industry($event)"></add_industry>
        </div>

        <!----------------edit industry------------------>
        <div class="modal fade" id="edit_industryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <edit_industry :base_url="base_url" :industry="industry" @update_industry="update_industry($event)"></edit_industry>
        </div>

    </div>
</template>

<script>
import ClientTable from 'vue-client-table';
import add_industry from './addindustryModal.vue';
import edit_industry from './editindustryModal.vue';
export default {

components:{
    ClientTable,
    add_industry,
    edit_industry
},
        props: ['base_url'],

        data(){
            return {
                industries:[],
                industry:'',
                columns: ['industry_name','action'],
    options: {
      headings: {
        industry: 'industry_name',
        action:'Action'

      },
      editableColumns:['industry_name'],
      sortable: ['industry_name'],
      filterable: ['industry_name']
    }
  }

        },

        mounted(){
            this.getindustries();

        },

        methods:{

            getindustries() {
                axios.get(this.base_url+'/api/company/industry')
                .then(res => (
                    this.industries = res.data
                ))
            },

            add_industry(){
                $('#add_industryModal').modal('toggle');
            },

            save_industry(data){
                this.industries.push(data);
                $('#add_industryModal').modal('hide');
                notify_message('industry Added Successfully','success')
            },

            delete_industry(cat_id){
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover thisfile!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.delete(this.base_url+'/api/company/industry/'+cat_id)
                        .then(res => {

                            if(res.data.status == 'error'){
                                swal({
                                    text:res.data.msg,
                                    icon:'warning'
                                })
                            }
                            else{
                             notify_message(res.data.msg,'success');
                             this.getindustries();
                            }
                        })
                    }
                });
            },

            edit_industry(industry){
                $('#edit_industryModal').modal('toggle');
                this.industry = industry;
            },

            update_industry(data){
                this.getindustries();
                $('#edit_industryModal').modal('hide');
                notify_message('industry Updated Successfully','success')
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
