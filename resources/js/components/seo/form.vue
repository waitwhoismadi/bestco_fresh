<template>

<form method="get" @submit.prevent="submit_seodata">

                <div class="form-group">
                    <label>Page*</label>
                        <select class="form-control" v-model="pageid" @change="getpagedata">
                            <option value="">Select Page</option>
                            <option :value="page.id" v-for="(page) in pages" :key="page.id">{{ page.page_name }}</option>
                        </select>

                </div>

                <div class="form-group">
                    <label>Seo Title*</label>
                    <input type="text" name="seo_title" class="form-control" :class="{'is-invalid':errors.seo_title}" placeholder="Seo Title" v-model="page_data.seo_title">
                     <small id="helpId" class="text-muted">Enter <strong>{page_name}</strong> to get User/Company name or job/project detail</small>
                    <div class="text-danger" v-if="errors.seo_title" >
                            <span v-for="(title_error,index) in errors.seo_title" :key="index">
                                {{ title_error }}
                            </span>
                        </div>
                </div>

                <div class="form-group">
                    <label>Seo tags</label>
                    <input type="text" name="seo_tags" class="form-control" placeholder="Seo Tags" v-model="page_data.seo_tags">

                </div>

                <div class="form-group">
                    <label>Seo Page Img</label>
                    <input type="file" name="seo_img" class="form-control">

                </div>

                <div class="form-group">
                    <label>Seo Description</label>
                    <textarea name="seo_description" class="form-control" :class="{'is-invalid':errors.seo_description}" placeholder="Seo Description"  v-model="page_data.seo_description"></textarea>
                    <small id="helpId" class="text-muted">Enter <strong>{page_name}</strong> to get User/Company name or job/project detail</small>

                        <div class="text-danger" v-if="errors.seo_description" >
                            <span v-for="(description_error,index) in errors.seo_description" :key="index">
                                {{ description_error }}
                            </span>
                        </div>
                </div>
                <button type="submit" class="btn btn-success" v-if="!btn_disabled">Update</button>
                <button type="submit" class="btn btn-success" disabled v-if="btn_disabled">Loading</button>
            </form>

</template>

<script>
export default {

    props:['base_url','pages'],

    data(){
        return {
            pageid:'',
            page_data:Object,
            errors:Object,
            btn_disabled:false
        }
    },

    methods:{

        getpagedata(){

            axios.get(this.base_url+"/api/getseo_data/"+this.pageid)
            .then(res => {
                this.page_data = res.data;
            })
        },

        submit_seodata(){

            this.btn_disabled = true;
            axios.post(this.base_url+"/api/submit_seodata",{
                page_type:this.pageid,
                seo_title:this.page_data.seo_title,
                seo_tags:this.page_data.seo_tags,
                seo_img:this.page_data.seo_img,
                seo_description:this.page_data.seo_description
                })
            .then(res => {
                if(res.data.status == 'success'){

                   notify_message('Update seo data successfully','success');
                }
                else{

                    this.errors = res.data.errors;
                    notify_message('Validation errors','error');
                }
                this.btn_disabled = false;
            })
        }
    }
}
</script>
