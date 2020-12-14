const version = '0.001'
module.exports = {
	filenameHashing: false,
	publicPath: process.env.NODE_ENV === 'production' ? '/increscendo/assets' : '/',
    outputDir: '../assets',
    indexPath: '../index.html',
	devServer: {
		proxy: 'http://localhost/increscendo_app'
	},
  	chainWebpack: config => {
  		config.output
  		.filename(`js/[name].[hash].${version}.js`)
  		.chunkFilename(`js/[name].[hash].${version}.js`)
  	}
}