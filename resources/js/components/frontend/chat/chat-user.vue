<template>

    <ul>

         <li @click="start_chat(
                                                new_user
                                )"
                                :id="'user'+new_user" class="users_list" v-if="new_user">
                                    <div class="usr-msg-details">
                                        <div class="usr-ms-img">
                                            <img :src="base_url+'/storage/'+new_user.image" alt="">

                                            <!-- <span class="msg-status"></span> -->
                                        </div>
                                        <div class="usr-mg-info">
                                            <h3>
                                                {{ new_user.name }}
                                            </h3>
                                            <p>...
                                            </p>
                                        </div><!--usr-mg-info end-->
                                        <span class="posted_time">
                                            now
                                        </span>

                                    </div><!--usr-msg-details end-->
                                </li>
                                <li v-for="(chatuser) in users" :key="chatuser.id" @click="start_chat(
                                                chatuser
                                )"
                                :id="(chatuser.sender_id == auth_user.id)?
                                                'user'+chatuser.receiver.id:
                                                'user'+chatuser.sender.id
                                                " class="users_list">
                                    <div class="usr-msg-details">
                                        <div class="usr-ms-img">
                                            <img :src="(chatuser.sender_id == auth_user.id)?
                                                base_url+'/storage/'+chatuser.receiver.image:
                                                base_url+'/storage/'+chatuser.sender.image
                                                " alt="">

                                            <!-- <span class="msg-status"></span> -->
                                        </div>
                                        <div class="usr-mg-info">
                                            <h3>
                                                {{(chatuser.sender_id == auth_user.id)?
                                                chatuser.receiver.name:
                                                chatuser.sender.name
                                                }}
                                            </h3>
                                            <p>{{ chatuser.message.substring(0,20)+".." }}
                                            </p>
                                        </div><!--usr-mg-info end-->
                                        <span class="posted_time">
                                            <timeago :datetime="chatuser.created_at" :auto-update="60"></timeago>
                                        </span>
                                        <!-- <span class="msg-notifc">{{ get_last_msg(chatuser.chat_id,'unread') }}</span> -->
                                    </div><!--usr-msg-details end-->
                                </li>

                            </ul>
</template>

<script>
export default {

    props:['auth_user','base_url','custom_user'],

    data(){
        return {
            users:[],
            is_active:false,
            new_user:''
        }
    },

    mounted(){
        this.get_chat_users();
        if(this.custom_user){

            axios.get(this.base_url+"/api/get-custom-user/"+this.custom_user)
            .then(res => {

                if(res.data.status == 'not-found'){

                this.new_user =res.data.user;
                this.start_chat(res.data.user);

                }
                else{
                    this.start_chat(res.data.user);

                }
            })
        }
    },

    methods:{

        get_chat_users(){

            axios.get(this.base_url+"/api/get-chat-users")
            .then(res =>{
                this.users = res.data
            })
        },

        start_chat(receiver){

            $('.users_list').removeClass('active');

            if(this.new_user.id == receiver.id){
                var user = receiver
            }
            else{
            if(receiver.sender.id == this.auth_user.id){
            var user = receiver.receiver
            }
            else{
                var user = receiver.sender
            }
            }

            $('#user'+user.id).addClass('active');

            this.$emit('start_user',{'receiver':receiver,'chat_user':user,'messages':''})
        },


        async get_last_msg(chat_id,type){

           return await Promise.resolve(axios.get(this.base_url+"/api/get-last-msg/"+chat_id+'/'+type))



        },



    }
}
</script>
