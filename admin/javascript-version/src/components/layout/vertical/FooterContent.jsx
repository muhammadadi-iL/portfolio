'use client'

// Next Imports
import Link from 'next/link'

// Third-party Imports
import classnames from 'classnames'

// Hook Imports
import useVerticalNav from '@menu/hooks/useVerticalNav'

// Util Imports
import { verticalLayoutClasses } from '@layouts/utils/layoutClasses'

const FooterContent = () => {
  // Hooks
  const { isBreakpointReached } = useVerticalNav()

  return (
    <div
      className={classnames(verticalLayoutClasses.footerContent, 'flex items-center justify-between flex-wrap gap-4')}
    >
      <p>
        <span>{`Copyright © ${new Date().getFullYear()},`}</span>
        <span>{` All rights reserved by `}</span>
        <Link href='mailto:adilm0616@gmail.com' className='text-primary'>
          Admin Portal
        </Link>
      </p>
    </div>
  )
}

export default FooterContent
