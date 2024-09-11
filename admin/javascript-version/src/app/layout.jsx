// Third-party Imports
import 'react-perfect-scrollbar/dist/css/styles.css'

// Style Imports
import '@/app/globals.css'

// Generated Icon CSS Imports
import '@assets/iconify-icons/generated-icons.css'

export const metadata = {
  title: 'Admin Panel',
  description:
    'Develop admin panel in next.js connect to backend in laravel 11'
}

const RootLayout = ({ children }) => {
  // Vars
  const direction = 'ltr'
  const maincontent = () => {
    const existingLink = document.getElementsByTagName('style');
    if (existingLink) {
      existingLink.remove();
    }

  };

  return (

    <html id='__next' dir={direction}>

    <body className='flex is-full min-bs-full flex-auto flex-col'>{children}
    <maincontent/>
    </body>

    </html>

  )
}

export default RootLayout
