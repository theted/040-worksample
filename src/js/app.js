const endpoint = 'http://040.herp.se?page=data'
const addParticipantButton = document.querySelector('#add-participant')
let numParticipants = 1

// add button bindings
addParticipantButton.addEventListener('click', event => {
  event.preventDefault();
  console.log('Add a new participant...')
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
