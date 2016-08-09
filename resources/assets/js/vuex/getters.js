// This getter is a function which just returns the count
// With ES6 you can also write it as:
// export const getCount = state => state.count
export const getMessage = state => state.message
export const getRecordState = state => state.recordState
export function getCount (state) {
  return state.count
}
