<template>
     <div class="main-conversation-box">
                        <div class="message-bar-head">
                            <div class="usr-msg-details">
                                <div class="usr-ms-img">
                                    <img :src="base_url+'/storage/'+chat_user.image" alt="">
                                </div>
                                <div class="usr-mg-info">
                                    <h3>{{chat_user.name}}</h3>
                                    <p>{{chat_user.online_status?'online':'Offline'}}</p>
                                </div><!--usr-mg-info end-->
                            </div>
                            <a href="#" title=""><i class="fa fa-ellipsis-v"></i></a>
                        </div><!--message-bar-head end-->
                        <ul class="messages-line" v-chat-scroll="{always: false, smooth: true}">
                            <li class="main-message-box  my-4 py-4">


                            </li><!--main-message-box end-->


                            <li class="main-message-box "
                            v-for="message in messages"
                            :key="message.id"
                            :class="{'ta-right':(message.sender.id === auth_user.id),'st3':message.sender.id !== auth_user.id}"
                            >
                                <div class="message-dt"
                                :class="{'st3':message.sender.id != auth_user.id}">
                                    <div class="message-inner-dt">
                                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p> -->
                                    <p>{{message.message}}</p>
                                    </div><!--message-inner-dt end-->
                                    <span>{{ message.created_at | moment("ddd, MMM  DD, hh:mm a")}}</span>
                                </div><!--message-dt end-->
                                <div class="messg-usr-img">
                                    <img :src="
                                                base_url+'/storage/'+message.sender.image"

                                     alt="">
                                </div><!--messg-usr-img end-->

                            </li><!--main-message-box end-->


                        </ul><!--messages-line end-->
                        <div class="message-send-area">
                            <form @submit.prevent="send_msg">
                                <div class="mf-field">
                                    <input type="text" name="message" placeholder="Type a message here" v-model="msg_text">
                                    <button type="submit">Send</button>
                                </div>
                                <!-- <ul>
                                    <li><a href="#" title=""><i class="fas fa-smile"></i></a></li>
                                    <li><a href="#" title=""><i class="fas fa-camera"></i></a></li>
                                    <li><a href="#" title=""><i class="fas fa-paperclip"></i></a></li>
                                </ul> -->
                            </form>
                        </div><!--message-send-area end-->
                    </div><!--main-conversation-box end-->
</template>

<script>
export default {

    props:['auth_user','base_url','receiver','chat_user','messages','custom_message'],

    data(){
        return{
             msg_text:'',
        }
    },

    created(){

        this.msg_text = this.custom_message;
        // if(this.receiver.sender.id == this.auth_user.id){
        //     this.user = this.receiver.receiver
        // }
        // else{
        //     this.user = this.receiver.sender
        // }
        // if(this.receiver){
        // this.get_chat_messages()
        // }

    },

    methods:{

        get_chat_messages(){

            axios.get(this.base_url+"/api/get-chat-messages/"+this.receiver.chat_id)
            .then(res => {
                this.messages = res.data
            })
        },

        send_msg(){

            this.messages.push({
                message:this.msg_text,
                sender:this.auth_user,
                receiver:this.chat_user

            })
            axios.post(this.base_url+'/api/send_msg',{'msg':this.msg_text,'receiver':this.chat_user.id})
            .then(res => {
                this.msg_text = '';

            })
        }


    }

}
</script>

<style>
.mCustomScrollBox{
    height: 604px !important;
}
</style>
