module.exports = {
	filenameHashing: false,
	publicPath: process.env.NODE_ENV === 'production' ? '/assets' : '/',
    outputDir: '../assets',
    indexPath: '../index.html',
	devServer: {
		proxy: 'http://localhost/increscendo_app'
	}
}