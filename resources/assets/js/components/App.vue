<template>
  <tabs addClass="is-centered">
    <tab name="Your Top 20" :selected="true">
      <div class="box" v-for="(item, index) in yourTop20" :key="item.id">
        <div class="columns is-mobile">
          <div class="column is-narrow has-text-grey has-text-centered" style="min-width: 80px;">
            <div class="is-size-5" style="color: #000">
              <span>{{ index + 1 }}</span>
            </div>
          </div>
          
          <div class="column is-narrow">
            <figure class="image is-48x48">
              <img :src="JSON.parse(item.track_data).album.images[2].url" :alt="JSON.parse(item.track_data).album.name + 'Album image'">
            </figure>
          </div>
          <div class="column">
            <div class="title is-5 has-text-weight-normal">
              <a :href="JSON.parse(item.track_data).external_urls.spotify" target="_blank">{{ item.track_name }}</a>
            </div>
            <div class="subtitle is-6 has-text-grey">
              {{ item.track_artist }}
            </div>
          </div>
        </div>
      </div>
    </tab>

    <tab name="Mirum Top 20">
      <div class="box" v-for="(item, index) in mirumTop20" :key="item.id">
        <div class="columns is-mobile">
          <div class="column is-narrow has-text-grey has-text-centered" style="min-width: 80px;">
            <div class="is-size-5" style="color: #000">
              <span>{{ index + 1 }}</span>
            </div>
            <div class="is-size-7">
              <span class="is-size-7"><i :class="['fas', getArrowIcon(index + 1, item.last_position )]"></i></span> {{ getLastTermPositionLabel(item.last_position) }}
            </div>
          </div>
          
          <div class="column is-narrow">
            <figure class="image is-48x48">
              <img :src="JSON.parse(item.track_data).album.images[2].url" :alt="JSON.parse(item.track_data).album.name + 'Album image'">
            </figure>
          </div>
          <div class="column">
            <div class="title is-5 has-text-weight-normal">
              <a :href="JSON.parse(item.track_data).external_urls.spotify" target="_blank">{{ item.track_name }}</a>
            </div>
            <div class="subtitle is-6 has-text-grey">
              {{ item.track_artist }}
            </div>
          </div>
        </div>
      </div>
    </tab>
  </tabs>
</template>

<script>
import Tabs from './Tabs'
import Tab from './Tab'

export default {
  components: {
    Tabs,
    Tab
  },
  data() {
    return {
      yourTop20: window.yourTop20,
      mirumTop20: window.mirumTop20
    }
  },
  methods: {
    getArrowIcon: function(curr, last) {
      if (!last) {
        return;
      }

      if (curr < last) {
        return 'has-text-success fa-arrow-up';
      } else if (curr > last) {
        return 'has-text-danger fa-arrow-down';
      } else if (curr == last) {
        return 'has-text-info fa-arrows-alt-h';
      } else {
        return 'has-text-warning fa-star';
      }
    },
    getLastTermPositionLabel: function(position) {
      return position ? '(' + position + ')' : position;
    }
  }
}
</script>
