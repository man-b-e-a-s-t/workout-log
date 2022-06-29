import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

import { Workout } from './workout.interface';

import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class WorkoutService {

  private workoutTypes: any;

  constructor(private http: HttpClient) { }

  getWorkouts(): Observable<Workout[]> {
    return this.http.get<Workout[]>(`${environment.api}/workout/read.php`);
  }

  getWorkout(workoutId: string): Observable<Workout> {
    return this.http.get<Workout>(`${environment.api}/workout/read.php?id=${workoutId}`);
  }
}
