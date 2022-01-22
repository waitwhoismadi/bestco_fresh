<template>
    <div class="row">
                <div class="col-lg-4 col-md-12 no-pdd">
                    <div class="msgs-list">
                        <div class="msg-title">
                            <h3>Messages</h3>
                            <!-- <ul>
                                <li><a href="#" title=""><i class="fa fa-cog"></i></a></li>
                                <li><a href="#" title=""><i class="fa fa-ellipsis-v"></i></a></li>
                            </ul> -->
                        </div><!--msg-title end-->
                        <div class="messages-list">

                            <frontend_chat_users :auth_user="auth_user" :base_url="base_url" @start_user="start_user($event)" :custom_user="custom_user"></frontend_chat_users>
                        </div><!--messages-list end-->
                    </div><!--msgs-list end-->
                </div>
                <div class="col-lg-8 col-md-12 pd-right-none pd-left-none">
                    <frontend_start_chat v-if="!receiver" :base_url="base_url"></frontend_start_chat>
                    <frontend_chat_messages :auth_user="auth_user" :base_url="base_url" :receiver="receiver" :chat_user="chat_user" :messages="messages" :custom_message="custom_msg" v-if="receiver"></frontend_chat_messages>
                </div>
            </div>
</template>

<script>
import frontend_chat_users from './chat-user.vue';
import frontend_chat_messages from './chat-messages.vue';
import frontend_start_chat from './start-chat.vue';

export default {

    props:['auth_user','base_url','custom_user','custom_msg'],

    data(){
        return {
            receiver:'',
            chat_user:'',
            messages:[],
        }
    },

    methods:{

        start_user(data){


            this.receiver = data.receiver;
            this.chat_user = data.chat_user;
            this.messages = data.messages
            if(data.receiver){
                if(data.receiver.chat_id){
                    var chat_id = data.receiver.chat_id
                }
                else{
                    var chat_id = data.receiver.id
                }
                console.log(data.receiver.id);
             axios.get(this.base_url+"/api/get-chat-messages/"+chat_id)
            .then(res => {
                this.messages = res.data
            })
            }
        }
    },

    components:{
        frontend_chat_users,
        frontend_chat_messages,
        frontend_start_chat
    }
}
</script>
