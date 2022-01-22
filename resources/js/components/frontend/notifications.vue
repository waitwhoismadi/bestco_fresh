<template>

<div>
<notifications_list v-for="notification in notifications" :key="notification.id" :notification="notification" :base_url="base_url" :user="user"></notifications_list>

</div>
</template>

<script>

import notifications_list from './notification_list.vue';
export default {

    components:{
        notifications_list
    },
    props:['base_url','notifications','user'],

    data(){
        return{
            notifications_list : [],
            addmsg :''
        }
    },

    mounted(){
        this.notifications_list = this.notifications;

        Echo.private('App.User.' + this.user.id)
    .notification((notification) => {
        console.log(notification);
        this.addmsg = 'new';
    });
    },

    methods:{

    }
}
</script>
