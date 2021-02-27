import axios from 'axios'
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
      showFeedback: false,
      submitted: false,
    }
  },
  template: `
    <div data-html2canvas-ignore>
      <div class="w-full shadow bg-white p-5 fixed top-0 sm:top-auto sm:right-5 sm:bottom-20 sm:max-w-sm sm:rounded-lg" v-if="showFeedback">
        <div v-if="submitted">
          <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
          <div class="mt-3 text-center sm:mt-5">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
              Feedback Received
            </h3>
            <button type="button" @click="reset" class="mt-5 w-full px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Done
            </button>
          </div>
        </div>
        <form class="flex flex-col space-y-5" @submit.prevent="submit" v-else>
          <select v-model="form.type" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="" disabled>Select Type</option>
            <option value="idea">Idea</option>
            <option value="feedback">Feedback</option>
            <option value="bug">Bug</option>
          </select>
          <textarea v-model="form.text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="3" placeholder="Enter some feedback..."></textarea>
          <div class="flex flex-col space-y-5 sm:flex-row sm:space-x-2 sm:space-y-0">
            <button type="button" @click="takeScreenshot" class="flex-1 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" v-if="!form.screenshot">
              Take Screenshot
            </button>
            <button type="button" @click="removeScreenshot" class="flex-1 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" v-else>
              Remove Screenshot
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
    async takeScreenshot() {
      try {
        const screen = await (await import('@gripeless/pico')).dataURL(window, {
          ignore: ['#feedback'],
        })

        this.form.screenshot = screen.value
      } catch (err) {
        console.error(err)
      }
    },
    removeScreenshot() {
      this.form.screenshot = ''
    },
    submit() {
      axios.post('/feedback', this.form)
        .then((response) => this.submitted = true)
        .catch((error) => console.error(error))
    },
    reset() {
      this.form.type = ''
      this.form.text = ''
      this.form.screenshot = ''
      this.showFeedback = false
      this.submitted = false
    }
  }
}).mount('#feedback')
