import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

import { WorkoutExercise } from './workoutExercise.interface';

import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class WorkoutExerciseService {

  constructor(private http: HttpClient) { }

  getWorkoutExercises(): Observable<WorkoutExercise[]> {
    return this.http.get<WorkoutExercise[]>(`${environment.api}/workoutExercise/read.php`);
  }

  getWorkoutExercisesByWorkout(workoutId: number): Observable<WorkoutExercise[]> {
    return this.http.get<WorkoutExercise[]>(`${environment.api}/workoutExercise/read.php?workoutId=${workoutId}`);
  }

  getWorkoutExercisesByExercise(exerciseId: number): Observable<WorkoutExercise[]> {
    return this.http.get<WorkoutExercise[]>(`${environment.api}/workoutExercise/read.php?exerciseId=${exerciseId}`);
  }

  getWorkoutExercise(workoutExerciseId: number): Observable<WorkoutExercise> {
    return this.http.get<WorkoutExercise>(`${environment.api}/workoutExercise/read.php?id=${workoutExerciseId}`);
  }
}
