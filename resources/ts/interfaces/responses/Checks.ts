import { Check } from './Check'

export interface Checks {
  pendings?: Check[];
  accepted?: Check[];
  rejected?: Check[];
}
