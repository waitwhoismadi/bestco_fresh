<template>

<div class="notfication-details">
                <div class="noty-user-img">
                    <img :src="base_url+'/storage/'+notification.data.user.image" alt="" class="rounded-pill">
                </div>
                <div class="notification-info">
                    <a :href="base_url+'/'+notification.data.feed.feed_type+'/'+notification.data.feed.slug" v-if="notification.data.type == 'feed_comment'">
                    <h3>
                        {{ notification.data.msg }}

                    </h3>
                    </a>
                    <a :href="base_url+'/'+user.role_type === 'company'?'company-profile':'user-profile'+'/setting?page=request'" v-else-if="notification.data.type == 'follow_request'">
                    <h3>
                        {{ notification.data.msg }}

                    </h3>
                    </a>
                    <a :href="base_url+'/project/'+notification.data.project.slug" v-else-if="notification.data.type == 'accept_bid'">
                    <h3>
                        {{ notification.data.msg }}

                    </h3>
                    </a>
                    <a :href="base_url+'/job/'+notification.data.job.slug" v-else-if="notification.data.type == 'job_apply'">
                    <h3>
                        {{ notification.data.msg }}

                    </h3>
                    </a>
                    <a :href="base_url+'/project/'+notification.data.project.slug" v-else-if="notification.data.type == 'post_bid'">
                    <h3>
                        {{ notification.data.msg }}

                    </h3>
                    </a>
                    <a :href="base_url+'/'+user.role_type === 'company'?'company-profile':'user-profile'+'/chat'" v-else-if="notification.data.type == 'send_msg'">
                    <h3>
                        {{ notification.data.msg }}

                    </h3>
                    </a>
                    <a v-else>
                    <h3>
                        {{ notification.data.msg }}

                    </h3>
                    </a>
                    <span>
                        <timeago :datetime="notification.created_at" :auto-update="60"></timeago>
                        </span>
                </div><!--notification-info -->
            </div>

</template>

<script>
export default {

    props:['notification','base_url','user'],

}
</script>
