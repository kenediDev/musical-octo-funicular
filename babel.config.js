module.exports = {
    presets: ["@babel/preset-env", "@babel/preset-typescript", "@vue/app"],
    plugins: [
        "@babel/plugin-transform-typescript",
        ["@babel/plugin-proposal-decorators", { legacy: true }]
    ]
};
