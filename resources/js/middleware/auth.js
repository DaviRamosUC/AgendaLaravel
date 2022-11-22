import redirect from '../router'
export default function auth({ next, router }) {
  if (!localStorage.getItem('token')) {
    redirect.push('/login');
  }
  return
}