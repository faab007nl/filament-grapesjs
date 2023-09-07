import grapesjs from "grapesjs";
import Swal from "sweetalert2";
import Toastify from 'toastify-js';

import blocksBasicPlugin from 'grapesjs-blocks-basic';
import countdownPlugin from 'grapesjs-component-countdown';
import exportPlugin from 'grapesjs-plugin-export';
import tabsPlugin from 'grapesjs-tabs';
import customCodePlugin from 'grapesjs-custom-code';
import touchPlugin from 'grapesjs-touch';
import tooltipPlugin from 'grapesjs-tooltip';
import typedPlugin from 'grapesjs-typed';
import presetWebpagePlugin from 'grapesjs-preset-webpage';

import "grapesjs/dist/css/grapes.min.css";
import "toastify-js/src/toastify.css";

document.addEventListener("alpine:init", function() {
    Alpine.data('someFormComponent', ({ state, someAttr }) => ({
        state,

        someAttr,

        init() {
            console.log(this.state)
        },
    }));

    if (window.grapesJsOptions === undefined) {
        console.error('GrapesJs options not defined');
        return;
    }
    const options = window.grapesJsOptions;
    const openEditorBtn = document.querySelector('[data-open-editor]');
    const editorContainer = document.querySelector('[data-editor-container]');

    let editorHasChanges = false;

    openEditorBtn.addEventListener('click', function() {
        editorContainer.classList.remove('editor-hidden');
    });

    const editor =  grapesjs.init({
        container: '#gjs',
        height: '1024px',
        width: '100%',
        storageManager: {
            type: 'remote',
            autosave: options.autosave,
            stepsBeforeSave: options.stepsBeforeSave,
            recovery: options.recovery,
            storeHtml: options.storeHtml,
            storeStyles: options.storeStyles,
            storeCss: options.storeCss,
            options: {
                remote: {
                    onLoad: function (data) {
                        editorHasChanges = false;
                    },
                    onStore: function (data) {

                    },
                },
            },
        },
        blockManager: {
            blocks: options.customBlocks,
        },
        plugins: [
            blocksBasicPlugin,
            countdownPlugin,
            exportPlugin,
            tabsPlugin,
            customCodePlugin,
            touchPlugin,
            tooltipPlugin,
            typedPlugin,
            presetWebpagePlugin,
        ],
        pluginsOpts: {
            [blocksBasicPlugin]: { flexGrid: true },
            [countdownPlugin]: {
                countdownBlock: {
                    category: 'Extra',
                },
                dateInputType: 'datetime-local',
            },
            [tooltipPlugin]: {
                blockTooltip: {
                    category: 'Extra',
                }
            },
            [tabsPlugin]: {
                tabsBlock: {
                    category: 'Extra'
                }
            },
            [typedPlugin]: {
                block: {
                    category: 'Extra',
                    content: {
                        type: 'typed',
                        'type-speed': 40,
                        strings: [
                            'Text row one',
                            'Text row two',
                            'Text row three',
                        ],
                    }
                }
            },
            [presetWebpagePlugin]: {
                modalImportTitle: 'Import Template',
                modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Paste here your HTML/CSS and click Import</div>',
                modalImportContent: function(editor) {
                    return editor.getHtml() + '<style>'+editor.getCss()+'</style>'
                },
            },
        },
    });
    const panelManager = editor.Panels;

    editor.on('update', function(e) {
        editorHasChanges = true;
    });

    if (options.deviceManagerBtnEnabled) {
        // Change the devices dropdown to 3 buttons
        editor.getConfig().showDevices = 0;
        panelManager.addPanel({
            id: 'devices', buttons: [
                { id: "set-device-desktop", command: function (e) { return e.setDevice("Desktop") }, className: "fa fa-desktop", active: 1 },
                { id: "set-device-tablet", command: function (e) { return e.setDevice("Tablet") }, className: "fa fa-tablet" },
                { id: "set-device-mobile", command: function (e) { return e.setDevice("Mobile portrait") }, className: "fa fa-mobile" }
            ]
        });
    }else{
        editor.getConfig().showDevices = 0;
    }

    if(!options.viewComponentsBtnEnabled){
        panelManager.removeButton('options', 'sw-visibility');
    }
    if(!options.previewBtnEnabled){
        panelManager.removeButton('options', 'preview');
    }
    if(!options.viewCodeBtnEnabled){
        panelManager.removeButton('options', 'export-template');
    }
    if(!options.fullscreenBtnEnabled){
        panelManager.removeButton('options', 'fullscreen');
    }

    if(options.undoBtnEnabled){
        panelManager.addButton('options', {
            id: 'undo',
            className: 'fa fa-undo',
            command: function () {
                editor.UndoManager.undo();
            }
        });
    }
    if(options.redoBtnEnabled){
        panelManager.addButton('options', {
            id: 'redo',
            className: 'fa fa-repeat',
            command: function () {
                editor.UndoManager.redo();
            }
        });
    }
    if(options.importBtnEnabled){
        panelManager.addButton('options', {
            id: 'import',
            className: 'fa fa-download',
            command: function () {
                editor.runCommand('gjs-open-import-webpage');
            }
        });
    }
    if(options.clearCanvasBtnEnabled){
        panelManager.addButton('options', {
            id: 'clear',
            className: 'fa fa-trash',
            command: function () {
                Swal.fire({
                    title: 'Are you sure?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        editor.runCommand('core:canvas-clear');
                        Toastify({
                            text: "Canvas cleared!",
                            className: "toastify-success",
                        }).showToast();
                    }
                });
            }
        });
    }

    panelManager.addButton('options', {
        id: 'save',
        className: 'fa fa-save',
        command: function () {
            editor.store().then(r => {
                Toastify({
                    text: "Saved!",
                    className: "toastify-success",
                }).showToast();
            });
        }
    });
    panelManager.addButton('options', {
        id: 'exit',
        className: 'fa fa-times',
        command: function () {
            if (editorHasChanges) {
                Swal.fire({
                    title: 'Do you want to save the changes?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        editor.store().then(r => {
                            Toastify({
                                text: "Saved!",
                                className: "toastify-success",
                            }).showToast();
                        });
                        editorContainer.classList.add('editor-hidden');
                    } else if (result.isDenied) {
                        editorContainer.classList.add('editor-hidden');
                    }
                });
            }else{
                editorContainer.classList.add('editor-hidden');
            }
        }
    });


});
