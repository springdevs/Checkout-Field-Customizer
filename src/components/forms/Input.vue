<template>
  <div class="cfc-admin-form-col">
    <label v-if="field.label" :for="field.name">{{ field.label }}</label>
    <input
      :id="field.name"
      :type="field.type"
      :placeholder="field.placeholder"
      :value="field.value"
      @input="$emit('input', $event.target.value)"
    />
  </div>
</template>

<script>
export default {
  name: "Input",
  props: ["field"]
};
</script>
