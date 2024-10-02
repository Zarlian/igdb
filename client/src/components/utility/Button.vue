<template>
    <button
        :class="{ 'my-button': true, 'my-button--primary': primary, 'my-button--secondary': !primary, 'my-button--hover': isHover }"
        @mouseover="isHover = true"
        @mouseout="isHover = false"
        :style="{ backgroundColor: backgroundColor, color: color, borderRadius: borderRadius }">
      <span v-if="iconPosition === 'before'" class="icon"><Icon :icon="icon" :width="iconSize" :height="iconSize" :color="iconColor"/></span>
      <span>{{ text }}</span>
      <span v-if="iconPosition === 'after'" class="icon"><Icon :icon="icon" :width="iconSize" :height="iconSize" :color="iconColor"/></span>
    </button>
</template>

<script>
import {Icon} from "@iconify/vue";

export default {
  components: {Icon},
  props: {
    text: String,
    backgroundColor: String,
    borderRadius: {
      type: String,
      default: '4px'
    },
    color: String,
    primary: {
      type: Boolean,
      default: true
    },
    icon: String,
    iconSize: String,
    iconColor: {
      type: String,
      default: 'white'
    },
    iconPosition: {
      type: String,
      default: '' // You can set a default position if none is provided
    }
  },
  data() {
    return {
      isHover: false
    };
  }
};
</script>


<style>
.my-button {
  width: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 2rem;
  padding: 0rem 0.75rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}
.icon{
  display: flex;
  justify-content: center;
  padding: 0 0.15rem;
}

.my-button:hover {
  background-color: #252525 !important;
  color: var(--color-text-white) !important;
}

.my-button:active {
  background-color: #737373 !important;
  color: var(--color-text-white) !important;
}

.my-button--primary {
  background-color: #121212;
  color: var(--color-text-white);
}


</style>