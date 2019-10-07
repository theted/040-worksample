const endpoint = 'https://040.herp.se?page=data'
const addParticipantButton = document.querySelector('#add-participant')
const participantsElem = document.querySelector('#participants')
let numParticipants = 1

// add button bindings
addParticipantButton.addEventListener('click', event => {
  event.preventDefault()
  console.log('Creating new participant...')
  let newParticipant = document.createElement('course-participant')
  newParticipant.setAttribute('id', ++numParticipants)
  participantsElem.appendChild(newParticipant)
})

  // get courses data
  ; (async () => {

    // get courses JSON data from API endpoint
    const response = await fetch(endpoint)
    const coursesData = await response.json()

    const selectElement = document.querySelector('select[name="course"]')
    const dateElement = document.querySelector('select[name="date"]')

    selectElement.addEventListener('change', (event) => {
      let val = event.target.value
      let dates = coursesData[val].dates

      // remove current date options
      while (dateElement.options.length > 0) {
        dateElement.remove(dateElement.options.length - 1);
      }

      // add new data options
      for (i = 0; i < dates.length; i++) {
        var opt = document.createElement('option')
        opt.appendChild(document.createTextNode(dates[i]));
        opt.value = dates[i];
        dateElement.appendChild(opt)
      }

    })

  })()



// define custom add participant element
class CourseParticipant extends window.HTMLElement {
  constructor() {
    super()
  }

  init() {
    this.innerHTML = /* html */ `
        <div class="participant">
          <h3>Participant</h3>
          
          <label for="name">Name</label>
          <input name="name" />
          
          <label for="name">Phone number</label>
          <input name="phone" />
          
          <label for="name">Email</label>
          <input name="email" />
        </div>
      `

    this._titleElem = this.querySelector('h3')
    this._nameElem = this.querySelector('input[name="name"]')
    this._phoneElem = this.querySelector('input[name="phone"]')
    this._emailElem = this.querySelector('input[name="email"]')

    console.log(this._titleElem, '...')
    this._titleElem.textContent = 'Participant #' + this.id
    this._nameElem.setAttribute('name', 'participant' + this.id + '_name')
    this._phoneElem.setAttribute('name', 'participant' + this.id + '_phone')
    this._emailElem.setAttribute('name', 'participant' + this.id + '_email')
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
