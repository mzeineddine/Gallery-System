import { Routes, Route } from "react-router";
import '../styles/App.css'
import '../styles/index.css'
import Login from './Login.jsx'
import Signup from './Signup.jsx'
import Gallery from './Gallery.jsx'
import Edit from './Edit.jsx'
import Add from './Add.jsx'
function App() {

  return (
    <>
      <Routes>
        <Route path="/" element={<Login />} />
        <Route path="/signup" element={<Signup />} />
        <Route path="/Gallery" element={<Gallery />} />
        <Route path="/Edit" element={<Edit />} />
        <Route path='/Add' element={<Add />} />
      </Routes>
    </>
  )
}

export default App
