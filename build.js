import * as esbuild from 'esbuild';
import {sassPlugin} from 'esbuild-sass-plugin';
import postcss from 'postcss';
import autoprefixer from 'autoprefixer';

const isDev = process.argv.includes('--dev')

async function compile(options) {
    const context = await esbuild.context(options)

    if (isDev) {
        await context.watch()
    } else {
        await context.rebuild()
        await context.dispose()
    }
}

const options = {
    define: {
        'process.env.NODE_ENV': isDev ? `'development'` : `'production'`,
    },
    bundle: true,
    mainFields: ['module', 'main'],
    platform: 'neutral',
    sourcemap: isDev ? 'inline' : false,
    sourcesContent: isDev,
    treeShaking: true,
    target: ['es2020'],
    minify: !isDev,
    entryPoints: [
        './resources/js/components/filament-grapesjs-component.js',
        './resources/css/grapes.scss'
    ],
    outdir: './resources/dist',
    plugins: [
        {
            name: 'watchPlugin',
            setup: function (build) {
                build.onStart(() => {
                    console.log(`Build started at ${new Date(Date.now()).toLocaleTimeString()}: ${build.initialOptions.outdir}`)
                })

                build.onEnd((result) => {
                    if (result.errors.length > 0) {
                        console.log(`Build failed at ${new Date(Date.now()).toLocaleTimeString()}: ${build.initialOptions.outdir}`, result.errors)
                    } else {
                        console.log(`Build finished at ${new Date(Date.now()).toLocaleTimeString()}: ${build.initialOptions.outdir}`)
                    }
                })
            }
        },
        sassPlugin({
            filter: /\.scss$/,
            async transform(source) {
                const { css } = await postcss([autoprefixer]).process(source, { from: undefined });
                return css;
            },
        })
    ],
}

compile(options)
    .then(() => console.log("⚡ Build complete! ⚡"))
    .catch(() => process.exit(1));
