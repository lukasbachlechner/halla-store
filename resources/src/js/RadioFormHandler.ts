export default class RadioFormHandler {
    private radioButtonList: NodeListOf<HTMLElement>;
    private form: HTMLElement;
    private formRadioButtonId: string;

    constructor(radioButtonList: string, form: string, formRadioButton: string) {
        this.radioButtonList = document.getElementsByName(radioButtonList);
        this.formRadioButtonId = formRadioButton;
        this.form = document.querySelector(form);
        if (this.radioButtonList) {
            this.radioButtonList.forEach(radio => {
                radio.addEventListener('click', (e) => this.handleRadioChange(e));
            })
        }
    }

    private handleRadioChange(e: Event) {
        const clickedRadio = e.target as HTMLInputElement;
        if (clickedRadio.getAttribute('id') === this.formRadioButtonId) {
            this.form.style.display = 'block';
        } else {
            this.form.style.display = 'none';
        }
    }
}