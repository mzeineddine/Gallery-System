import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import { BrowserRouter} from "react-router";
import './styles/index.css'
import Login from './Pages/Login.jsx'
import Signup from './Pages/Signup.jsx'
import Gallery from './Pages/Gallery.jsx'
import Edit from './Pages/Edit.jsx'
import Add from './Pages/Add.jsx'
import App from './Pages/App.jsx';

createRoot(document.getElementById('root')).render(
  <BrowserRouter>
    <App />
  </BrowserRouter>
)
