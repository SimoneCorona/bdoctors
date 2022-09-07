<template>
    <!-- INIZIO SLIDER CONTAINER -->
    <div class="sponsorship container overflow-hidden mt-5">
      <!-- TITOLO SLIDER -->
      <h2 class="mb-5 pb-5"><span class="first-letter">M</span>edici in evidenza</h2>
      <!-- INIZIO SLIDER -->
      <div class="container-fluid">
        <div class="row d-flex align-items-center">
          <!-- BOTTONE PREV -->
          <div class="col-3">
            <div class="small-circle prev" @click="showPrev">
              <img :src="sponsored_users[prev].photo ? sponsored_users[prev].photo : 'img/img-not-found.png'" alt=""> alt="">
            </div>
          </div>
          <!-- / BOTTONE PREV -->
          <div class="col-6 d-flex justify-content-center">
            <!-- CARD CHE SI GIRA -->
            <div class="mycard">
              <div class="mycard__inner">
                <!-- FRONTE -->
                <div class="mycard__front">
                  <div class="sponsored-doctor ">
                    <div class="sponsored-doctor__img">
                      <img :src="sponsored_users[counter].photo ? sponsored_users[counter].photo : 'img/img-not-found.png'" alt="">
                    </div>
                    <div class="sponsored-doctor__info">
                      <h4 class="name">
                        {{ sponsored_users[counter].name }} {{ sponsored_users[counter].surname }}
                      </h4>
                      <h5 class="specialty" v-for="(specialty, index) in sponsored_users[counter].specialties" :key="index">
                        {{ specialty.specialty_name }}
                      </h5>
                    </div>
                  </div>
                </div>
                <!-- RETRO -->
                <div class="mycard__back d-flex flex-column">
                  <h3 class="number">
                    {{ sponsored_users[counter].phone_number }}
                  </h3>
                  <h4 class="email">
                    {{ sponsored_users[counter].email }}
                  </h4>
                </div>
              </div>
            </div>
          </div>
          <!-- / CARD CHE SI GIRA -->

          <!-- BOTTONE NEXT -->
          <div class="col-3">
            <div class="small-circle next" @click="showNext">
              <img :src="sponsored_users[next].photo ? sponsored_users[next].photo : 'img/img-not-found.png'" alt=""> alt="">
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
    name: 'DoctorCard',
}
</script>