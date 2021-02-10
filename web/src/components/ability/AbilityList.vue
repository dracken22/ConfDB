<template>
  <h1>Liste des habilités</h1>
  <el-table :data="abilities" style="width: 100%" stripe>
    <el-table-column prop="id" label="Id"></el-table-column>
    <el-table-column prop="name.labels[1].label" label="Nom"></el-table-column>
    <el-table-column prop="description.labels[1].label" label="Description"></el-table-column>
  </el-table>
</template>

<script lang="ts">
import { ref, defineComponent, reactive, onMounted } from 'vue'
import { AbilityApi } from '../../model/ability/ability.api';
import { Ability } from '../../model/ability/ability.model';
const abilityApi = new AbilityApi();

export default defineComponent({
  name: 'AbilityList',
  props: {},
  setup: () => {
    const abilities = ref<Ability[]>([]);

    onMounted(() => {
      abilityApi.list().then((res) => {
        abilities.value = res;
      });
    });

    return {abilities};
  },
})
</script>

<style scoped>

</style>
