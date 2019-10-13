const selectElement = document.querySelector('select[name="course"]')
const dateElement = document.querySelector('select[name="date"]')
const addParticipantButton = document.querySelector('#add-participant')
const participantsElem = document.querySelector('#participants')
let numParticipants = 1

// change course event binding
selectElement.addEventListener('change', (event) => {
  let val = event.target.value
  let dates = coursesData[val].dates

  resetOptions(dateElement)

  if (dates.length) {
    addSelectOption(dates, dateElement)
  }

})

const addSelectOption = (options, element) => {
  for (i = 0; i < options.length; i++) {
    var opt = document.createElement('option')
    opt.appendChild(document.createTextNode(options[i]));
    opt.value = i;
    element.appendChild(opt)
  }
}

const resetOptions = element => {
  while (element.options.length > 0) {
    element.remove(element.options.length - 1);
  }
}

// create new participant
addParticipantButton.addEventListener('click', event => {
  event.preventDefault()
  console.log('Creating new participant...')
  let newParticipant = document.createElement('course-participant')
  newParticipant.setAttribute('id', ++numParticipants)
  participantsElem.appendChild(newParticipant)
})
