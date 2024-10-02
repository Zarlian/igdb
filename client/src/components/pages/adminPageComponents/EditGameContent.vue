<template>
  <div class="content">
    <div class="button-container">
      <div class="add-buttons">
        <Button :text="'Add Image url'" color="white" icon="ic:baseline-add" icon-position="after" icon-color="white"
                icon-size="1.5rem" border-radius="10px" @click="showImageUrlModal"/>
        <Button :text="'Add Video url'" color="white" icon="ic:baseline-add" icon-position="after" icon-color="white"
                icon-size="1.5rem" border-radius="10px" @click="showTrailerUrlModal"/>
      </div>

      <Button :text="'Cancel'" color="white" icon="ic:baseline-cancel" icon-position="after" icon-color="white"
              icon-size="1.5rem" border-radius="10px" @click="handleCancel"/>
    </div>

    <div class="image-preview">
      <section>
        <h2>Image Preview</h2>
        <div class="image-container">
          <img :src="gameData.cover" :alt="gameData.cover" v-if="gameData.cover"/>
          <img v-for="url in gameData.screenshots" :key="url" :src="url" :alt="gameData.cover"/>
        </div>
      </section>
    </div>

    <div class="trailer-preview">
      <section>
        <h2>Trailer Preview</h2>
        <div class="image-container">
          <iframe v-for="url in gameData.trailers" :key="url" :src="url" title="trailer"/>
        </div>
      </section>
    </div>

    <div class="game-data">
      <label for="title">Title</label>
      <input type="text" id="title" v-model="gameData.title"/>

      <label for="date">Release Date</label>
      <input type="date" id="date" v-model="gameData.release_date"/>

      <label for="esrb_rating">ESRB rating</label>
      <input type="text" id="esrb_rating" v-model="gameData.esrb_rating"/>

      <label for="genres">Genres</label>
      <div class="genre-container">
        <select v-for="(genreId, index) in gameData.genres" :key="index" v-model="gameData.genres[index]" name="genres"
                id="genres">
          <option v-for="genre in genres" :key="genre.id" :value="genre.id">{{ genre.name }}</option>
        </select>
        <Icon icon="ic:baseline-add" width="2rem" height="2rem" style="color: #6d6d6d" @click="addGenre"/>
      </div>

      <label for="developer">Developer</label>
      <div class="developer-container">
        <select name="developer" id="developer" v-model="gameData.developer_id">
          <option v-for="developer in developers" :key="developer.id" :value="developer.id">{{
              developer.name
            }}
          </option>
        </select>
      </div>

      <label for="platforms">Platforms</label>
      <div class="platform-container">
        <select v-for="(platformName, index) in gameData.platforms" :key="index" v-model="gameData.platforms[index]"
                name="platforms" id="platforms">
          <option v-for="platform in platforms" :key="platform.id" :value="platform.id"
                  :selected="platformName === platform.name">{{ platform.name }}
          </option>
        </select>
        <Icon icon="ic:baseline-add" width="2rem" height="2rem" style="color: #6d6d6d" @click="addPlatform"/>
      </div>

      <div class="translatable-container">
        <div class="translatable" v-for="(translation, index) in gameData.translations" :key="index">
          <label :for="`language-${index}`">Language:</label>
          <input type="text" :id="`language-${index}`" v-model="translation.language" disabled/>

          <label :for="`short_descr-${index}`">Short Description</label>
          <textarea :id="`short_descr-${index}`" cols="30" rows="10" v-model="translation.short_description"></textarea>

          <label :for="`long_descr-${index}`">Long Description</label>
          <textarea :id="`long_descr-${index}`" cols="30" rows="10" v-model="translation.long_description"></textarea>
        </div>
      </div>

      <Button :text="'Save'" color="white" icon="ic:baseline-save" icon-position="after" icon-color="white"
              icon-size="1.5rem" border-radius="10px" @click="handleSave"/>
    </div>

    <Modal
        v-if="isImageUrlModalVisible"
        title="Add Image URL"
        :isVisible="isImageUrlModalVisible"
        @save="handleImageUrlSave"
        @close="handleModalClose"
    />
    <Modal
        v-if="isTrailerUrlModalVisible"
        title="Add Trailer URL"
        :isVisible="isTrailerUrlModalVisible"
        @save="handleTrailerUrlSave"
        @close="handleModalClose"
    />
  </div>
</template>

<script>
import Button from "@/components/utility/Button.vue";
import Modal from "@/components/utility/modals/UrlModal.vue";
import {Icon} from "@iconify/vue";
import AdminGameService from "@/scripts/services/adminService.js";

export default {
  name: "EditGameContent",
  emits: ['saveGame', 'goToGames'],
  props: {
    type: {type: String, required: true},

    game: {
      type: Object,
      default: () => ({
        cover: '',
        screenshots: [],
        trailers: [],
        title: '',
        release_date: '',
        esrb_rating: '',
        genres: [],
        developer_id: '',
        platforms: [],
        translations: [{
          language: 'en',
          short_description: '',
          long_description: ''
        },
          {
            language: 'nl',
            short_description: '',
            long_description: ''
          },
          {
            language: 'fr',
            short_description: '',
            long_description: ''
          }],
      }),
    },
  },
  components: {Icon, Button, Modal},
  data() {
    return {
      genres: [],
      developers: [],
      platforms: [],
      gameData: {},
      isImageUrlModalVisible: false,
      isTrailerUrlModalVisible: false,
      service: new AdminGameService()
    };
  },
  async mounted() {
    const genres = await this.service.getGenres();
    this.genres = genres.data;
    const developers = await this.service.getDevelopers();
    this.developers = developers.data;
    const platforms = await this.service.getPlatforms();
    this.platforms = platforms.data;
    this.gameData = {...this.game};
  },
  methods: {
    showImageUrlModal() {
      this.isImageUrlModalVisible = true;
    },
    showTrailerUrlModal() {
      this.isTrailerUrlModalVisible = true;
    },
    handleModalClose() {
      this.isImageUrlModalVisible = false;
      this.isTrailerUrlModalVisible = false;
    },
    handleImageUrlSave(url) {
      this.gameData.screenshots.push(url);
      this.handleModalClose();
    },
    handleTrailerUrlSave(url) {
      this.gameData.trailers.push(url);
      this.handleModalClose();
    },
    handleSave() {
      this.createResponseGame();
      console.log(this.type)
      this.$emit('saveGame', this.gameData, this.type);
    },
    handleCancel() {
      this.$emit('goToGames');
    },
    addGenre() {
      this.gameData.genres.push('');
    },
    addPlatform() {
      this.gameData.platforms.push('');
    },
    createResponseGame() {
      this.gameData.featured = false;
      this.gameData.cover = this.gameData.screenshots[0];
    }
  }
}
</script>


<style scoped>

.content {
  flex: 1;
  padding: 1.5rem;
  width: 100%;

  border: solid 1px #adadad;
  border-radius: 10px;
  margin: 2rem 0;
}

.button-container {
  display: flex;
  justify-content: space-between;
  margin-bottom: 1.5rem;
}

.add-buttons {
  display: flex;
  gap: 1rem;
}

.image-preview h2, .trailer-preview h2 {
  font-weight: bold;
  font-size: 1.5rem;
  margin-bottom: 0.5rem;
}

.image-preview .image-container, .trailer-preview .image-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 1rem;
  background-color: #cbcbcb;
  padding: 1rem;
  border-radius: 10px;
  margin-bottom: 1.5rem;
}

.image-preview img, .trailer-preview iframe {
  border: #1f1f1f solid 1px;
  height: 10rem;
}

.game-data {
  display: flex;
  flex-direction: column;
}

.game-data label {
  font-weight: bold;
  font-size: 1rem;
  margin-bottom: 0.5rem;
}

.game-data input, .game-data select {
  box-sizing: border-box;
  width: 15rem;
  padding: 0.5rem;
  border-radius: 4px;
  border: 1px solid #adadad;
  color: #6d6d6d;
  margin-bottom: 1rem;
}

.game-data select {
  width: 7.5rem;
  margin-bottom: 0;
}

.game-data svg {
  border-radius: 50px;
  padding: 0.25rem;
}

.game-data svg:hover {
  background-color: #b4b4b4;
  cursor: pointer;
}

.genre-container, .developer-container, .platform-container {
  display: flex;
  gap: 1rem;
  align-items: center;
  margin-bottom: 1rem;
}

#developer {
  width: 15rem;
}

.translatable-container {
  display: flex;
  justify-content: space-between;
}

.translatable {
  width: 30%;
  margin-bottom: 1rem;
  display: flex;
  flex-direction: column;
}

</style>