<template>
    <div class="container">
        <div class="row">
            <!-- Contenitore: foto info di base -->
            <div class="col-6">
                <div class="container">
                    <div class="row">
                        <!-- Avatar -->
                        <div class="col-6">
                            Avatarjhgdfkjerjikrejkfehrfk
                        </div>
                        <!-- Info di base -->
                        <div class="col-6">
                            Info di base
                        </div>
                    </div>
                    <div class="row">
                        <!-- Prestazioni -->
                        <div class="col-12">
                            Prestazioni
                        </div>
                    </div>
                </div>
            </div>
            <!-- CV utente (con scroll) -->
            <div class="col-6">
                cv
            </div>
        </div>
    </div>
</template>

<script>
import { computed } from 'vue';
export default {
    name: 'SingleDoctor',
    data() {
        return {
            user: [],
            rating: 0,
            clicked_rating: 0,
            review_author:'',
            review_text:'',
            errors: {
                review: [],
                message: []
            }
        }    
    },
    created() {
        this.getSingleDoctor();
    },
    methods: {
        getSingleDoctor() {
            const slug = this.$route.params.slug;
             axios.get(`/api/users/${slug}`)
             .then((resp) => {
            if (resp.data.success) {
                this.user = resp.data.results;
            } else {
                this.$router.push({name: 'not-found'});
            }  
            })
        },
        colorStarOnHover(rating) {
            this.rating = rating;
        },
        showClickedStar() {
            this.rating = this.clicked_rating;
        },
        clickRating() {
            this.clicked_rating = this.rating;
        },
        postReview() {
            this.errors.review = [];
            if (this.review_author === '') {
                this.errors.review.push('author');
            } 
            if (this.clicked_rating === 0) {
                this.errors.review.push('rating');
            }
            if (this.errors.review.length > 0) {
                return
            }
            axios.post('/api/review',{
                user_id: this.user.id,
                author: this.review_author,
                rating: this.clicked_rating,
                text_review: this.review_text,
            })
             .then((resp) => {
            if (resp.data.success) {
                this.getSingleDoctor();
            } else {
                // this.$router.push({name: ''});
                // console.log(typeof(resp.data))
                // console.log(resp.data.response);
                for (const key in resp.data.response) {
                    this.errors.review.push(key);
                    // console.log(key);
                }
            }  
            })
        },
        
    },
    computed: {
        starsInReviews () {
            return Math.round(this.user.avg_rating)
            console.log(this.starsInReviews())
        }
    }
};
</script>

<style scoped lang="scss">
.fas{
    color: rgb(255, 242, 0);
}
</style>