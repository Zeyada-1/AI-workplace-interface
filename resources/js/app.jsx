import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'

function ReactButton() {
  return (
    <button>A simple React button</button>
  );
}

createRoot(document.querySelector('#react-content')).render(
  <StrictMode>
    <ReactButton/>
  </StrictMode>,
)
