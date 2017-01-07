<template>
    <div style="height:32px">
        <a class="button is-loading is-primary" v-if="loading">
            <span class="icon is-small">
                    <i class="fa fa-heart"></i>
                </span>
        </a>
        <p class="level-item has-addons" v-if="status == 'Anonymous' && loading!=true">
            <a  href="/login"
                    class="button is-success">
                    <span class="icon is-small">
                        <i class="fa fa-heart"></i>
                    </span>
                    <span v-if="likes > 0">
                        {{ likes }}
                    </span>
            </a>
        </p>
        <p class="control has-addons" v-if="status == 'notLiked' && loading!=true">
            <a      @click="toggleLike"
                    class="level-item button is-success">
                    <span class="icon is-small">
                        <i class="fa fa-heart"></i>
                    </span>
                    <span v-if="likes > 0">
                        {{ likes }}
                    </span>
            </a>
        </p>
        <p class="control has-addons" v-if="status == 'Liked' && loading!=true">
            <a      @click="toggleLike"
                class="level-item button is-danger">
                <span class="icon is-small">
                    <i class="fa fa-heart"></i>
                </span>
                <span v-if="likes > 0">
                    {{ likes }}
                </span>
            </a>
        </p>
        </p>
    </div>
</template>

<script>
    export default {
        mounted() {
            Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
            this.$http.get('/like/' + this.snippet_id)
                .then( (resp) => {
                    this.status = resp.body.status
                    this.loading = false
                })
            this.$http.get('/like/' + this.snippet_id + '/count')
                .then( (resp) => {
                    this.likes = resp.body.likes
                })
        },
        props:['snippet_id'],
        data() {
            return {
                status: '',
                likes : '',
                loading: true
            }
        },
        methods: {
            toggleLike()
            {
                this.loading = true;
                this.$http.post('/like/' + this.snippet_id)
                    .then( (resp) => {
                        this.status = resp.body.status
                        this.loading = false
                    })
                this.$http.get('/like/' + this.snippet_id + '/count')
                    .then( (resp) => {
                        this.likes = resp.body.likes
                    })
            }
        }
    }
</script>
