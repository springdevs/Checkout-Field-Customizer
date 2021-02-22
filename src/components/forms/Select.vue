<template>
  <div class="cfc-admin-form-col">
    <label :for="field.name">{{ field.label }}</label>
    <select
      :id="field.name"
      @change="$emit('selectInputData', $event.target.value)"
      @input="$emit('input', $event.target.value)"
      v-model="selected"
    >
      <option
        v-for="(option, index) in field.options"
        :key="index"
        :value="Object.keys(option)[0]"
      >
        {{ option[Object.keys(option)[0]] }}
      </option>
    </select>
  </div>
</template>

<script>
export default {
  name: "Select",
  props: ["field"],
  data() {
    return {
      selected: null,
    };
  },
  mounted() {
    this.selected = this.field.value;
  },
};
</script>