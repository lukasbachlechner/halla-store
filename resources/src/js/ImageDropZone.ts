export default class ImageDropZone {
    private readonly dropZoneFormGroup: HTMLElement;
    private dropZone: HTMLElement;
    private fileInput: HTMLInputElement;
    private uploadFileList: FileList;
    private uploadFilesSet: Set<File>;
    private thumbsList: HTMLUListElement;
    private thumbsContent: Map<string, string>;

    constructor(dropZoneFormGroup: string) {
        this.dropZoneFormGroup = document.querySelector(dropZoneFormGroup);

        if (this.dropZoneFormGroup) {
            this.dropZone = this.dropZoneFormGroup.querySelector('.drop-zone');
            this.fileInput = this.dropZoneFormGroup.querySelector('input.drop-zone__input');
            this.thumbsList = this.dropZoneFormGroup.querySelector('.drop-zone__thumbs-list');


            this.uploadFilesSet = new Set();
            this.thumbsContent = new Map();

            this.dropZone.addEventListener('dragover', (e) => this.handleDragOver(e));

            ['dragleave', 'dragend'].forEach(type => {
                this.dropZone.addEventListener(type, () => this.handleDragLeave());
            });

            this.dropZone.addEventListener('drop', (e) => this.handleDrop(e));
        }
    }

    private toggleClass(type: string) {
        if (type === 'ADD') {
            this.dropZone.classList.add('drop-zone--over');
        } else if (type === 'REMOVE') {
            this.dropZone.classList.remove('drop-zone--over');
        }
    }

    private handleDragOver(e: DragEvent) {
        e.preventDefault();
        this.toggleClass('ADD');
    }

    private handleDragLeave() {
        this.toggleClass('REMOVE');
    }

    private handleDrop(e: DragEvent) {
        e.preventDefault();

        // files from DragEvent
        const {files} = e.dataTransfer;

        if (files) {
            // loop over FileList as Array, add to uploadFilesSet only if it's an image
            Array.from(files).forEach(file => {
                console.log(this);
                if(file.type.startsWith('image/')) {
                    this.uploadFilesSet.add(file);
                } else {
                    alert('Dieses Dateiformat wird nicht unterstützt.');
                }
            });

            this.generateThumbnails();
            this.setFileInputFiles();
        }
        this.toggleClass('REMOVE');
    }

    private setFileInputFiles() {
        // temporary DataTransfer to get a valid FileList (can't be created directly)
        const tempDataTransfer = new DataTransfer();

        // add each item in the Set to the temporary DataTransfer
        this.uploadFilesSet.forEach(file => tempDataTransfer.items.add(file));

        // rewrite uploadFileList and set the files of the input to such
        this.uploadFileList = tempDataTransfer.files;
        this.fileInput.files = this.uploadFileList;
    }

    private generateThumbnails() {
        this.thumbsList.innerHTML = '';
        this.uploadFilesSet.forEach(file => {

            let fileContent = this.thumbsContent.get(file.name);

            if(fileContent === undefined) {
                const reader = new FileReader();

                reader.readAsDataURL(file);

                reader.addEventListener('load', () => {
                    fileContent = reader.result as string;
                    this.thumbsContent.set(file.name, fileContent);
                    this.appendThumbnail(fileContent);
                });
            } else {
                this.appendThumbnail(fileContent);
            }


        })
    }

    private appendThumbnail(fileContent: string) {
        const thumbItem = document.createElement('li');
        thumbItem.classList.add('drop-zone__thumbs-item');

        const thumbImg = document.createElement('img');
        thumbImg.classList.add('drop-zone__thumbs-img');
        thumbImg.src = fileContent;

        thumbItem.appendChild(thumbImg);
        this.thumbsList.appendChild(thumbItem);
    }
}