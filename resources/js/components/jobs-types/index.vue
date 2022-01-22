<template>
    <div class="w-100">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">All Types</h4>
            <button class="float-right btn btn-primary" @click="add_type()">Add type</button>



      <v-client-table :columns="columns" v-model="types" :options="options">
        <div slot="action" slot-scope="{ row }"><a href="#/">
                        <button class="btn btn-icons btn-rounded btn-success" @click="edit_type(row)"><i class="fa fa-pencil"></i></button></a>
                        <button class="btn btn-icons btn-rounded btn-danger" @click="delete_type(row.id)"><i class="fa fa-trash-o"></i></button></div>
      </v-client-table>
          </div>
        </div>


        <!----------------add type------------------>
        <div class="modal fade" id="add_typeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <add_type :base_url="base_url" @save_type="save_type($event)"></add_type>
        </div>

        <!----------------edit type------------------>
        <div class="modal fade" id="edit_typeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <edit_type :base_url="base_url" :type="type" @update_type="update_type($event)"></edit_type>
        </div>

    </div>
</template>

<script>
import ClientTable from 'vue-client-table';
import add_type from './addtypeModal.vue';
import edit_type from './edittypeModal.vue';
export default {

components:{
    ClientTable,
    add_type,
    edit_type
},
        props: ['base_url'],

        data(){
            return {
                types:[],
                type:'',
                columns: ['type','action'],
    options: {
      headings: {
        type: 'type Name',
        action:'Action'

      },
      editableColumns:['type'],
      sortable: ['type'],
      filterable: ['type']
    }
  }

        },

        mounted(){
            this.gettypes();

        },

        methods:{

            gettypes() {
                axios.get(this.base_url+'/api/jobs/type')
                .then(res => (
                    this.types = res.data
                ))
            },

            add_type(){
                $('#add_typeModal').modal('toggle');
            },

            save_type(data){
                this.types.push(data);
                $('#add_typeModal').modal('hide');
                notify_message('type Added Successfully','success')
            },

            delete_type(type_id){
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover thisfile!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.delete(this.base_url+'/api/jobs/type/'+type_id)
                        .then(res => {

                            if(res.data.status == 'error'){
                                swal({
                                    text:res.data.msg,
                                    icon:'warning'
                                })
                            }
                            else{
                             notify_message(res.data.msg,'success');
                             this.gettypes();
                            }
                        })
                    }
                });
            },

            edit_type(type){
                $('#edit_typeModal').modal('toggle');
                this.type = type;
            },

            update_type(data){
                this.gettypes();
                $('#edit_typeModal').modal('hide');
                notify_message('type Updated Successfully','success')
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
