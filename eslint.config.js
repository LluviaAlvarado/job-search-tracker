import eslint from "@eslint/js"
import vue from "eslint-plugin-vue"
import globals from "globals"

export default [
  eslint.configs.recommended,
  ...vue.configs["flat/recommended"],
  {
    files: ["**/*.js", "**/*.vue"],
    plugins: {
      vue: vue,
    },
    languageOptions: {
      ecmaVersion: "latest",
      sourceType: "module",
      globals: {
        ...globals.amd,
        ...globals.browser,
        ...globals.es6,
      },
    },
    rules: {
      indent: ["warn", 2],
      quotes: ["warn", "double"],
      semi: ["warn", "never"],
      "no-unused-vars": [
        "error",
        { vars: "all", args: "after-used", ignoreRestSiblings: true },
      ],
      "comma-dangle": ["warn", "always-multiline"],
      "vue/multi-word-component-names": "off",
      "vue/max-attributes-per-line": "off",
      "vue/no-v-html": "off",
      "vue/require-default-prop": "off",
      "vue/singleline-html-element-content-newline": "off",
      "vue/html-self-closing": [
        "warn",
        {
          html: {
            void: "always",
            normal: "always",
            component: "always",
          },
        },
      ],
      "vue/no-v-text-v-html-on-component": "off",
    },
  },
]
