<template>
     <div class="main-conversation-box">

                        <div class="messages-line">
                            <div class="main-message-box start-chat-section">

                                <img :src="base_url+'/images/chat-users.png'">
                                <p>Start Chat with users and companies. </p>

                            </div><!--main-message-box end-->

                        </div><!--messages-line end-->

                    </div><!--main-conversation-box end-->
</template>

<script>
export default {
    props:['base_url']
}
</script>
<style>
.start-chat-section{

    margin-top: 150px !important;
    text-align: center;
}
.start-chat-section p{
    font-size: 18px;
}
.start-chat-section img{
    width: 300px !important;
    float: none !important;
}
</style>
