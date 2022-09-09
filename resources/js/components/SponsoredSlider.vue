<template>
    <!-- INIZIO SLIDER CONTAINER -->
    <div class="sponsorship container overflow-hidden mt-5 text-center">
      <!-- TITOLO SLIDER -->
      <h2 class="mb-5 pb-5"><span class="first-letter">M</span>edici in evidenza</h2>
      <!-- INIZIO SLIDER -->
      <div class="container-fluid">
        <div class="row d-flex align-items-center">
          <!-- BOTTONE PREV -->
          <div class="col-3">
            <div class="small-circle prev" @click="showPrev" v-if="sponsored_users[prev]">
              <img :src="sponsored_users[prev].photo ? `/storage/${sponsored_users[prev].photo}` : 'img/img-not-found.png'" alt="">

            </div>
          </div>
          <!-- / BOTTONE PREV -->
          <div class="col-6 d-flex justify-content-center">
            <!-- CARD CHE SI GIRA -->
            <router-link :to="{ name: 'single-user', params: { slug: sponsored_users[counter].slug } }">
              <div class="mycard">
                <div class="mycard__inner">
                  <!-- FRONTE -->
                  <div class="mycard__front">
                    <div class="sponsored-doctor ">
                      <div class="sponsored-doctor__img" v-if="sponsored_users[counter]">
                        <img :src="sponsored_users[counter].photo ? `/storage/${sponsored_users[counter].photo}` : 'img/img-not-found.png'" alt="">
                      </div>
                      <div class="sponsored-doctor__info">
                        <h4 v-if="sponsored_users[counter]" class="name">
                          {{ sponsored_users[counter].name }} {{ sponsored_users[counter].surname }}
                        </h4>
                        <span v-if="sponsored_users[counter]">
                          <h5 class="specialty px-3" v-for="(specialty, index) in sponsored_users[counter].specialties" :key="index">
                          {{ specialty.specialty_name }}
                          </h5>
                        </span>
                      </div>
                    </div>
                  </div>
                  <!-- RETRO -->
                  <div class="mycard__back d-flex flex-column">
                    <h3 class="number" v-if="sponsored_users[counter]">
                      {{ sponsored_users[counter].phone_number }}
                    </h3>
                    <h4 class="email" v-if="sponsored_users[counter]">
                      {{ sponsored_users[counter].email }}
                    </h4>
                  </div>
                </div>
              </div>
              </router-link>
          </div>
          
          <!-- / CARD CHE SI GIRA -->

          <!-- BOTTONE NEXT -->
          <div class="col-3">
            <div class="small-circle next" @click="showNext" v-if="sponsored_users[next]">
              <img :src="sponsored_users[next].photo ? `/storage/${sponsored_users[next].photo}` : 'img/img-not-found.png'" alt="">
            </div>
          </div>
          <!-- / BOTTONE NEXT -->
        </div>
      </div>
    </div>
    <!-- FINE SLIDER CONTAINER -->
</template>

<script>
export default {
    name: 'SponsoredSlider',
    data() {
      return {
        sponsored_users: [],
        counter: '',
        prev: '',
        next: '',
      }
    },
    created() {
    this.getSponsorships();
      this.counter = 1;
      this.prev = 0;
      this.next = 2;
      setInterval(this.showNext, 5000);
    },
    methods: {
      getSponsorships() {
        axios.get('/api/sponsored-users')
        .then((resp) => {
          this.sponsored_users = resp.data.results.data;
        })
      },
      showPrev() {
        if (this.counter === 0) {
          this.counter = this.sponsored_users.length - 1;
        } else {
          this.counter--;
        }
        if (this.prev === 0) {
          this.prev = this.sponsored_users.length - 1;
        } else {
          this.prev--;
        }
        if (this.next === 0) {
          this.next = this.sponsored_users.length - 1;
        } else {
          this.next--;
        }
      },
      showNext() {
        if (this.counter >= this.sponsored_users.length - 1) {
          this.counter = 0;
        } else {
          this.counter++;
        }
        if (this.prev >= this.sponsored_users.length - 1) {
          this.prev = 0;
        } else {
          this.prev++;
        }
        if (this.next >= this.sponsored_users.length - 1) {
          this.next = 0;
        } else {
          this.next++;
        }
      },
    }
}
</script>

<style scoped lang="scss">
    .sponsorship {
      margin-bottom: 4rem;
      h2 {
        text-transform: uppercase;
        letter-spacing: .4rem;
        .first-letter {
          background-color: black;
          color: white;
          padding-left: .45rem;
          margin-right: .3rem;
        }
      }
    }
    .small-circle {
      width: 20vw;
      max-width: 300px;
      height: 20vw;
      max-height: 300px;
      outline: 3px solid black;
      outline-offset: 10px;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
      img {
        width: 100%;
        object-fit: cover;
        transition: .4s;
      }
      img:hover {
        transform: scale(110%);
        transition: .4s;
      }
    }
    .mycard {
      width: 30vw;
      max-width: 460px;
      height: 30vw;
      max-height: 450px;
      border-radius: 50%;
      outline: 5px solid black;
      outline-offset: 15px;
      perspective: 300px;
      
      &:hover .mycard__inner {
        transform: rotateY(180deg);
      }
      &__inner {
        width: 100%;
        height: 100%;
        position: relative;
        background-color: rgba($color: #000000, $alpha: .3);
        color: white;
        transform-style: preserve-3d;
        transition: transform 1s;
        border-radius: 50%;
        img {
          width: 100%;
          border-radius: 50%;
        }
      }
      &__front, &__back {
        width: 100%;
        height: 100%;
        position: absolute;
        backface-visibility: hidden;
        overflow: hidden;
        border-radius: 50%;
      }
      &__back {
        transform: rotateY(180deg);
        display: flex;
        justify-content: center;
        align-items: center;
        .number {
          display: inline-block;
          padding: 0 4rem .5rem;
          border-bottom: 3px solid black;
          font-size: 2rem;
        }
        .email {
          font-size: 2rem;
        }
      }
    }
    .sponsored-doctor {
      position: relative;
      width: 100%;
      height: 100%;
      &__img {
        width: 100%;
        height: 100%;
        position: absolute;
        }
        &__info {
          width: 100%;
          height: 100%;
          position: absolute;
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          text-align: center;
          background-color: rgba($color: #000000, $alpha: .2);
          .name {
            display: inline-block;
            padding: 0 10rem .5rem;
            border-bottom: 4px solid black;
            font-size: 3.5vw;
          }
          .specialty {
            font-size: 2.5vw;
          }
        }
      }
    .prev {
      transform: translate(-55%);
    }
    .next {
      transform: translate(55%);
    }
</style>

