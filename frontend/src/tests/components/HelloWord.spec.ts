import { render } from '@testing-library/vue';
import HelloWorld from '@/components/HelloWorld.vue';
import { createPinia, setActivePinia } from 'pinia';

beforeEach(() => {
  setActivePinia(createPinia());
});

describe('HelloWorld', () => {
  it('renders correctly', () => {
    const { getByText } = render(HelloWorld);
    getByText('components/HelloWorld.vue');
  });
});
