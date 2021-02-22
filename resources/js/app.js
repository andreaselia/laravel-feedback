import axios from 'axios'
import html2canvas from 'html2canvas'
import { createApp } from 'vue'

const feedbackElement = document.createElement('div')
feedbackElement.id = 'feedback'
document.body.appendChild(feedbackElement)

createApp({
  data() {
    return {
      form: {
        type: '',
        text: '',
        screenshot: '',
      },
      showFeedback: false
    }
  },
  template: `
    <div>
      <div class="w-full shadow bg-white p-5 fixed top-0 sm:top-auto sm:right-5 sm:bottom-20 sm:max-w-sm sm:rounded-lg" v-if="showFeedback">
        <form class="flex flex-col space-y-5" @submit.prevent="submit">
          <select v-model="form.type" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="" disabled>Select Type</option>
            <option value="idea">Idea</option>
            <option value="feedback">Feedback</option>
            <option value="bug">Bug</option>
          </select>
          <textarea v-model="form.text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="3" placeholder="Enter some feedback..."></textarea>
          <div class="flex flex-col space-y-5 sm:flex-row sm:space-x-2 sm:space-y-0">
            <button type="button" @click="screenshot" class="flex-1 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              {{ form.screenshot ? 'Screenshot Added' : 'Take Screenshot' }}
            </button>
            <button type="submit" class="flex-1 px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Send Feedback
            </button>
          </div>
        </form>
      </div>

      <button type="button" class="fixed bottom-5 right-5 px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="showFeedback = !showFeedback">
          Feedback
      </button>
    </div>
  `,
  methods: {
    screenshot() {
      if (this.form.screenshot) {
        this.form.screenshot = ''
        return
      }

      html2canvas(document.querySelector('body')).then(canvas => {
        this.form.screenshot = canvas.toDataURL()
      })
    },
    submit() {
      axios.post('/feedback', this.form)
        .then((response) => console.log(response))
        .catch((error) => console.error(error))
    }
  }
}).mount('#feedback')
