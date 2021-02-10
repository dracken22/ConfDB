<template>
  <el-menu :default-active="1" mode="horizontal" router="true">
    <el-submenu index="1">
      <template #title>Administrations</template>
      <el-menu-item index="1-1" route="/ability">Compétences</el-menu-item>
      <el-menu-item index="1-2" route="/army">Armées</el-menu-item>
    </el-submenu>
  </el-menu>
  <router-view></router-view>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

import AbilityList from './components/ability/AbilityList.vue';

export default defineComponent({
  name: 'App',
  components: {
    AbilityList
  }
})
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>