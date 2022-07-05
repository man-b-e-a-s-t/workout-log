import { Exercise } from "../exercises/exercise.interface";

export class WorkoutExercise {
  id: number = 0;
  userId: number = 0;
  workoutId: number = 0;
  exerciseId: string = ``;
  stepNumber: string = ``;
  weightGoal: number = 0;
  timeGoal: number = 0;
  setGoal: number = 0;
  repGoal: number = 0;
  notes: string = ``;
  created: string = ``;
  modified: string = ``;
  progressPercent: number = 0;
  exercise?: Exercise;
  sets?: WorkoutExerciseSet[];

  constructor(init?: Partial<WorkoutExercise>) {
    this.userId = -1; // get the current user's id

    this.weightGoal = init?.weightGoal || 0;
    this.timeGoal = init?.timeGoal || 0;
    this.setGoal = init?.setGoal || 0;
    this.repGoal = init?.repGoal || 0;

    if (init?.sets) {
      this.sets = init.sets;
    } else if (this.setGoal) {
      if (this.setGoal) {
        this.sets = [];
        while (this.sets.length < this.setGoal) {
          this.sets.push(new WorkoutExerciseSet());
        }
      }
    }

    const workoutPotential = this.setGoal * this.repGoal * (this.weightGoal || this.timeGoal);
    const workoutActual = this.sets ? this.sets.map(set => {
      return set.reps * (set.weight || set.time);
    }).reduce((partialSum, a) => partialSum + a, 0) : 0;
    console.log('workoutPotential', workoutPotential)
    console.log('workoutActual', workoutActual)
    this.progressPercent = workoutActual / workoutPotential * 100;
    // this.created = init?.created || new Date().toISOString();
    // this.modified = new Date().toISOString();
    Object.assign(this, init);
  }
}

export class WorkoutExerciseSet {
  id: string = ``;
  workout_exercise_id: string = ``;
  weight: number = 0;
  reps: number = 0;
  time: number = 0;
  created: string = ``;
  modified: string = ``;
}
