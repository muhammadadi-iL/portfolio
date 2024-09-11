/** @type {import('next').NextConfig} */

const nextConfig = {
  basePath: process.env.BASEPATH,
  publicRuntimeConfig: {
    apiUrl: process.env.NEXT_PUBLIC_API_URL || 'http://localhost:3000/api',
  },
}


export default nextConfig
