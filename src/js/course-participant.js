// define custom add participant element
class CourseParticipant extends window.HTMLElement {
  constructor() {
    super()
  }

  init() {
    this.innerHTML = /* html */ `
        <div class="participant">
          <h3>Participant</h3>
          
          <div>
            <div >
              <label for="name">Name</label>
              <input name="name" />
            </div>
            
            <div >
              <label for="name">Phone number</label>
              <input name="phone" />
            </div>

            <div>
              <label for="name">Email</label>
              <input name="email" />
            </div>
          </div>

          <div class="close">x</div>
        </div>
        `

    this._titleElem = this.querySelector('h3')
    this._nameElem = this.querySelector('input[name="name"]')
    this._phoneElem = this.querySelector('input[name="phone"]')
    this._emailElem = this.querySelector('input[name="email"]')
    this._closeElem = this.querySelector('.close')

    this._titleElem.textContent = 'Participant #' + this.id
    this._nameElem.setAttribute('name', 'participant' + this.id + '_name')
    this._phoneElem.setAttribute('name', 'participant' + this.id + '_phone')
    this._emailElem.setAttribute('name', 'participant' + this.id + '_email')

    this._closeElem.addEventListener('click', () => this.destroy())
  }

  validPhone(nr) {
    return value.match(/\d/g)
  }

  validEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }

  setId(id) {
    this.init()
  }

  get id() {
    return this.getAttribute('id');
  }

  set id(newValue) {
    this.setAttribute('id', newValue);
  }

  static get observedAttributes() {
    return ['id'];
  }

  attributeChangedCallback(name, oldValue, newValue) {
    switch (name) {
      case 'id': this.setId(newValue); break
    }
  }

}

// register custom HTML element
window.customElements.define('course-participant', CourseParticipant)
