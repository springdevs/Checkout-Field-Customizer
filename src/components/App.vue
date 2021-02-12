<template>
  <div>
    <Head />
    <Section />
    <button
      @click="$modal.show('my-first-modal')"
      style="margin-bottom: 15px"
      class="sdevs-button cfc-primary-button"
    >
      ADD NEW
    </button>
    <Card />
    <Form :tabs="tabs" />
  </div>
</template>

<script>
import Head from "./Head";
import Section from "./Section";
import Card from "./Card";
import Form from "./Form";
export default {
  name: "App",
  data() {
    return {
      tabs: [
        {
          label: "Labels",
          key: "cfc_checkout_label_tab",
          fields: [
            {
              row: [
                {
                  label: "Label",
                  type: "text",
                  name: "cfc-admin-label",
                  placeholder: "Enter Label",
                  value: null,
                },
                {
                  label: "Placeholder (optional)",
                  type: "text",
                  name: "cfc-admin-placeholder",
                  placeholder: "Enter placeholder",
                  value: null,
                },
              ],
            },
            {
              label: "Default Value (optional)",
              type: "text",
              name: "cfc-admin-value",
              placeholder: "Enter default value",
              value: null,
            },
            {
              label: "Description (optional)",
              type: "text",
              name: "cfc-admin-desc",
              placeholder: "Enter description",
              value: null,
            },
          ],
        },
        {
          label: "Settings",
          key: "cfc_checkout_settings_tab",
          fields: [
            {
              row: [
                {
                  label: "Type",
                  type: "select",
                  name: "cfc-admin-type",
                  value: "text",
                  options: [
                    { text: "Text" },
                    { tel: "Phone" },
                    { email: "Email" },
                    { password: "Password" },
                    { select: "Select" },
                    { textarea: "Textarea" },
                    { radio: "Radio" },
                  ],
                },
                {
                  label: "Name",
                  type: "text",
                  name: "cfc-admin-name",
                  placeholder: "Name must be unique !!",
                  value: null,
                },
              ],
            },
            {
              row: [
                {
                  label: "Status",
                  type: "select",
                  name: "cfc-admin-status",
                  value: "enable",
                  options: [{ enable: "Enable" }, { disable: "Disable" }],
                },
                {
                  label: "Required",
                  type: "select",
                  name: "cfc-admin-required",
                  value: "yes",
                  options: [{ yes: "Yes" }, { no: "No" }],
                },
              ],
            },
            {
              row: [
                {
                  label: "Display in Emails",
                  type: "select",
                  name: "cfc-admin-display-email",
                  value: "yes",
                  options: [{ yes: "Yes" }, { no: "No" }],
                },
                {
                  label: "Display in Order Detail Pages",
                  type: "select",
                  name: "cfc-admin-display-order",
                  value: "yes",
                  options: [{ yes: "Yes" }, { no: "No" }],
                },
              ],
            },
            {
              label: "Options",
              type: "multi",
              conditional: true,
              target_field: "cfc-admin-type",
              name: "cfc-admin-options",
              values: ["select", "radio"],
            },
          ],
        },
        {
          label: "Styling",
          key: "cfc_checkout_style_tab",
          fields: [
            {
              label: "Class",
              type: "text",
              name: "cfc-admin-class",
              placeholder: "Enter class name",
              value: "form-row-wide",
            },
          ],
        },
      ],
    };
  },
  components: {
    Head,
    Section,
    Card,
    Form,
  },
};
</script>

<style>
</style>
